<template>
  <form>
    <OrganismsImgsCardProfile
      @emitInput="receiveProfileImage"
      :pathHeader="teamStore.getTeamDetail.urlHeaderImg"
      :pathThumbnail="teamStore.getTeamDetail.urlThumbnail"
    />
    {{ teamStore.getTeamDetail }}
    <v-card-title class="w-60 text-body-2 text-left ml-auto">
      <AtomsTextsHeadLine class="w-100">
        <AtomsInput
          placeholder="チーム名"
          type="text"
          @emitInput="receiveTeamName"
          :val="teamStore.getTeamDetail.teamName"
        />
      </AtomsTextsHeadLine>
    </v-card-title>
    <v-card-text>
      <AtomsTextAreas
        placeholder="チーム紹介"
        @emitInput="receiveTeamIntroduce"
        :body="teamStore.getTeamDetail.introduction"
      />
    </v-card-text>
    <v-container>
      <AtomsTextsHeadLine> ギャラリー </AtomsTextsHeadLine>
      <OrganismsDrugAndDrop
        @emitImages="receiveImage"
        :class="gallery.getDisplayImages.length > 0 ? 'absolute opacity-0' : ''"
      />
      <OrganismsGallery
        :images="gallery.getDisplayImages"
        @emitClick="receiveClick"
      />
    </v-container>
    <OrganismsAuthRecruitTeamInfo/>
    <v-container>
      <AtomsTextsHeadLine> これからの活動予定 </AtomsTextsHeadLine>
      <AtomsTextAreas
        class="mt-2"
        placeholder="これからの活動内容を記入"
        @emitInput="receiveTeamSchedule"
        :body="teamStore.getTeamDetail.schedule"
      />
    </v-container>
    <AtomsBtnsBaseBtn
      width="16rem"
      color="info"
      class="my-4 d-block mx-auto"
      @emitClick="handleRegister"
      v-if="!teamStore.getTeamDetail.itemId"
    >
      登録
    </AtomsBtnsBaseBtn>
    <AtomsBtnsBaseBtn
      width="16rem"
      color="orange"
      class="my-4 d-block mx-auto"
      @click="handleUpdate"
      :disabled="!checkFilledOut()"
      v-if="teamStore.getTeamDetail.itemId"
    >
      更新
    </AtomsBtnsBaseBtn>
    <OrganismsModal
      v-if="teamStore.getTeamDetail.itemId"
      @emitModalOpen="handleDelete"
      color="red"
      caution="※削除すると元に戻せなくなります。削除しますか？"
      btnValue="削除する"
      btnType="delete"
    >
      削除
    </OrganismsModal>

  </form>
</template>

<script setup lang="ts">
import { Message } from "~/constants/flashMessage";
import { Url } from "~/constants/url";
import { useApiFetch } from "~/composables/useApiFetch";
import { useAuthStore } from "~/stores/useAuthStore";
import { useFlashMessageStore } from "~/stores/useFlashMessageStore";
import { useGalleryStore } from "~/stores/useGalleryStore";
import { useTeamStore } from "~/stores/useTeamStore";
import { Form } from "vee-validate";

const auth = useAuthStore();
const teamStore = useTeamStore();
const flashMessage = useFlashMessageStore();
const gallery = useGalleryStore();
const deleteCheck = ref(false);
const receiveTeamName = (val) => {
  teamStore.details.teamName = val.value;
};

const receiveTeamIntroduce = (val) => {
  teamStore.details.introduction = val.value;
};

const receiveTeamSchedule = (val) => {
  teamStore.details.schedule = val.value;
};

const receiveProfileImage = (val: File) => {
  if (val.target == "header") {
    teamStore.details.headerImg = val.val;
    teamStore.details.urlHeaderImg = URL.createObjectURL(val.val);
  } else {
    teamStore.details.thumbnail = val.val;
    teamStore.details.urlThumbnail = URL.createObjectURL(val.val);
  }
  // URL.revokeObjectURL(val.val);
};

const handleRegister = async () => {
  teamStore.details.memberCount += 1;
  const formData = new FormData();

  formData.append("header_img", teamStore.details.headerImg);
  formData.append("thumbnail", teamStore.details.thumbnail);
  formData.append("introduction", teamStore.details.introduction);
  formData.append("team_name", teamStore.details.teamName);
  formData.append("member", teamStore.details.memberCount);
  formData.append("average", teamStore.details.average);
  formData.append("from_age", teamStore.details.fromAge);
  formData.append("to_age", teamStore.details.toAge);
  const rides = teamStore.details.rides;
  rides.forEach((ride) => {
    formData.append("rides[]", ride);
  });
  formData.append("detail_activity", teamStore.details.detailActivities);
  const areas = teamStore.details.areas;
  areas.forEach((area) => {
    formData.append("areas[]", area);
  });
  formData.append("detail_area", teamStore.details.detailAreas);
  formData.append("active_date", teamStore.details.activeDate);
  formData.append("active_date_detail", teamStore.details.activeDateDetail);
  formData.append("team_url", teamStore.details.teamUrl);
  formData.append("schedule", teamStore.details.schedule);

  const imageData = new FormData();
  gallery.getPostImages.forEach((image) => {
    imageData.append("images[]", image);
  });

  // console.log(...formData.entries());
  // console.log(...teamData.entries());
  // console.log(...imageData.entries());

  await useApiFetch("/sanctum/csrf-cookie");
  await Promise.all([
    useApiFetch("/api/team/register", {
      method: "POST",
      body: formData,
    }),
    useApiFetch("/api/image/register", {
      method: "POST",
      body: imageData,
    }),
  ]).then((res) => {
    console.log(res);
    if (res[0].error.value != null && res[0].error.value != null) {
      return flashMessage.setMessage(Message.REGISTERERROR, "error", 6000);
    }
    teamStore.details.itemId = res[0].data.value;
    return flashMessage.setMessage(Message.REGISTER);
  });
};
// console.log(teamStore.details.header_img);

const handleUpdate = async () => {
  const formData = new FormData();

  formData.append("header_img", teamStore.details.headerImg);
  formData.append("thumbnail", teamStore.details.thumbnail);
  formData.append("introduction", teamStore.details.introduction);
  formData.append("team_name", teamStore.details.teamName);
  formData.append("average", teamStore.details.average);
  formData.append("from_age", teamStore.details.fromAge);
  formData.append("to_age", teamStore.details.toAge);
  const rides = teamStore.details.rides;
  rides.forEach((ride) => {
    formData.append("rides[]", ride);
  });
  formData.append("detail_activities", teamStore.details.detailActivities);
  const areas = teamStore.details.areas;
  areas.forEach((area) => {
    formData.append("areas[]", area);
  });
  formData.append("detail_areas", teamStore.details.detailAreas);
  formData.append("active_date", teamStore.details.activeDate);
  formData.append("active_date_detail", teamStore.details.activeDateDetail);
  formData.append("team_url", teamStore.details.teamUrl);
  formData.append("schedule", teamStore.details.schedule);

  const imageData = new FormData();
  gallery.getPostImages.forEach((image) => {
    imageData.append("images[]", image);
  });
  //
  // console.log(...formData.entries());
  // console.log(...imageData.entries());

  await useApiFetch("/sanctum/csrf-cookie");
  await Promise.all([
    useApiFetch(`/api/team/${auth.user.id}`, {
      method: "POST",
      body: formData,
      headers: {
        "X-HTTP-Method-Override": "PUT",
      },
    }),
    useApiFetch(`/api/image/${auth.user.id}`, {
      method: "POST",
      body: imageData,
      headers: {
        "X-HTTP-Method-Override": "PUT",
      },
    }),
  ]).then((res) => {
    if (res[0].error.value != null && res[0].error.value != null) {
      return flashMessage.setMessage(Message.UPDATEERROR, "error", 6000);
    }
    // gallery.revokeImages();
    teamStore.details.itemId = res[0].data.value;
    return flashMessage.setMessage(Message.UPDATE);
  });
};

const handleDelete = async () => {
  if (deleteCheck) {
    await useApiFetch("/sanctum/csrf-cookie");
    await Promise.all([
      await useApiFetch(`/api/team/${teamStore.details.itemId}`, {
        method: "DELETE",
      }),
      await useApiFetch(`/api/image/${auth.user.id}`, {
        method: "DELETE",
      }),
    ]).then((res) => {
      console.log(res);
      if (res[0].error.value != null && res[0].error.value != null) {
        return flashMessage.setMessage(Message.DELETEERROR, "error", 6000);
      }

      return flashMessage.setMessage(Message.DELETE);
    });

    return navigateTo(Url.AUTHRECRUIT);
  }
};

const checkFilledOut = () => {
  const fieldArray = [teamStore.details.teamName, teamStore.details.introduction];

  if (fieldArray.indexOf("") === -1) {
    return true;
  }
  return false;
};

const receiveImage = (val) => {
  gallery.setImages(val.files);
};

// const displayImages = computed(()=>{
//   const baseUrl =  config.public.baseURL + "/storage/";
//   // gallery.getDisplayImages.forEach(image =>{

//   // })
// })

// const deleteItem = () => {
//   toggleDelete.value = !toggleDelete.value;
// };

onMounted(async () => {
    if(teamStore.getTeamDetail.itemId == ''){
    teamStore.fetchMyTeams();
  }
  });


</script>

<style lang="scss" scoped>
.v-card {
  overflow: hidden !important;
  border-radius: 10px;
}
.v-avatar {
  position: absolute !important;
  bottom: -40px;
  left: 20px;
  z-index: 1;
}

.v-responsive {
  position: unset !important;
}
.v-file-input {
  opacity: 0;
  position: absolute !important;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
  height: 100%;
  z-index: 10;
  background: red;
}
</style>
