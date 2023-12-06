<template>
  <form>
    <OrganismsImgsCardProfile
      @emitInput="receiveProfileImage"
      :pathHeader="teamItems.urlHeaderImg"
      :pathThumbnail="teamItems.urlThumbnail"
    />
    <v-card-title class="w-60 text-body-2 text-left ml-auto">
      <AtomsTextsHeadLine class="w-100">
        <AtomsInput
          placeholder="チーム名"
          type="text"
          @emitInput="receiveTeamName"
          :val="teamItems.teamName"
        />
      </AtomsTextsHeadLine>
    </v-card-title>
    <v-card-text>
      <AtomsTextAreas
        placeholder="チーム紹介"
        @emitInput="receiveTeamIntroduce"
        :body="teamItems.introduction"
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
    <OrganismsAuthRecruitTeamInfo
      @emitAgeAverage="receiveAverage"
      @emitFromAge="receiveFromAge"
      @emitToAge="receiveToAge"
      @emitRides="receiveRides"
      @emitAreas="receiveAreas"
      @emitDetailAreas="receiveDetailAreas"
      @emitDetailActivities="receiveDetailActivities"
      @emitActiveDate="receiveActiveDate"
      @emitActiveDateDetail="receiveActiveDateDetail"
      @emitTeamUrl="receiveTeamUrl"
      :memberCount="teamItems.memberCount"
      :average="teamItems.average"
      :fromAge="teamItems.fromAge"
      :toAge="teamItems.toAge"
      :rides="teamItems.rides"
      :areas="teamItems.areas"
      :detailActivities="teamItems.detailActivities"
      :detailAreas="teamItems.detailAreas"
      :activeDate="teamItems.activeDate"
      :activeDateDetail="teamItems.activeDateDetail"
      :team_url="teamItems.teamUrl"
    />
    <v-container>
      <AtomsTextsHeadLine> これからの活動予定 </AtomsTextsHeadLine>
      <AtomsTextAreas
        class="mt-2"
        placeholder="これからの活動内容を記入"
        @emitInput="receiveTeamSchedule"
        :body="teamItems.schedule"
      />
    </v-container>
    <AtomsBtnsBaseBtn
      width="16rem"
      color="info"
      class="my-4 d-block mx-auto"
      @emitClick="handleRegister"
      v-if="!teamItems.itemId"
    >
      登録
    </AtomsBtnsBaseBtn>
    <AtomsBtnsBaseBtn
      width="16rem"
      color="orange"
      class="my-4 d-block mx-auto"
      @click="handleUpdate"
      :disabled="!checkFilledOut()"
      v-if="teamItems.itemId"
    >
      更新
    </AtomsBtnsBaseBtn>
    <OrganismsModal
      v-if="teamItems.itemId"
      @emitModalOpen="handleCheck"
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
import { Form } from "vee-validate";


const config = useRuntimeConfig();
const auth = useAuthStore();
const flashMessage = useFlashMessageStore();
const gallery = useGalleryStore();
const deleteCheck = ref(false);

const teamItems = ref({
  pathHeader: "",
  pathThumbnail: "",
  itemId: "",
  userId: "",
  headerImg: "",
  thumbnail: "",
  teamName: "",
  average: "",
  fromAge: "",
  toAge: "",
  rides: [],
  areas: [],
  detailAreas: "",
  introduction: "",
  memberCount: 0,
  detailActivities: "",
  schedule: "",
  activeDate: "",
  activeDateDetail: "",
  teamUrl: "",
  urlHeaderImg: config.public.appURL + "/images/noimage.jpg",
  urlThumbnail: config.public.appURL + "/images/noimage.jpg",
});


const receiveTeamName = (val) => {
  teamItems.value.teamName = val.value;
};

const receiveTeamIntroduce = (val) => {
  teamItems.value.introduction = val.value;
};

const receiveTeamSchedule = (val) => {
  teamItems.value.schedule = val.value;
};

const receiveProfileImage = (val: File) => {
  if (val.target == "header") {
    teamItems.value.headerImg = val.val;
    teamItems.value.urlHeaderImg = URL.createObjectURL(val.val);
  } else {
    teamItems.value.thumbnail = val.val;
    teamItems.value.urlThumbnail = URL.createObjectURL(val.val);
  }
  // URL.revokeObjectURL(val.val);
};

const receiveAverage = (val) => {
  teamItems.value.average = val;
};
const receiveFromAge = (val) => {
  teamItems.value.fromAge = val;
};
const receiveToAge = (val) => {
  teamItems.value.toAge = val;
};
const receiveRides= (val) => {
  teamItems.value.rides = val;
};
const receiveDetailActivities = (val) => {
  teamItems.value.detailActivities = val;
};
const receiveAreas = (val) => {
  teamItems.value.areas = val;
};
const receiveDetailAreas = (val) => {
  teamItems.value.detailAreas = val;
};
const receiveTeamUrl = (val) => {
  teamItems.value.teamUrl = val;
};

const receiveActiveDate = (val) => {
  teamItems.value.activeDate = val;
};
const receiveActiveDateDetail = (val) => {
  teamItems.value.activeDateDetail = val;
};

const handleRegister = async () => {
  teamItems.value.memberCount += 1;
  const formData = new FormData();

  formData.append("header_img", teamItems.value.headerImg);
  formData.append("thumbnail", teamItems.value.thumbnail);
  formData.append("introduction", teamItems.value.introduction);
  formData.append("team_name", teamItems.value.teamName);
  formData.append("member", teamItems.value.memberCount);
  formData.append("average", teamItems.value.average);
  formData.append("from_age", teamItems.value.fromAge);
  formData.append("to_age", teamItems.value.toAge);
  const rides = teamItems.value.rides;
  rides.forEach((ride) => {
    formData.append("rides[]", ride);
  });
  formData.append("detail_activity", teamItems.value.detailActivities);
  const areas = teamItems.value.areas;
  areas.forEach((area) => {
    formData.append("areas[]", area);
  });
  formData.append("detail_area", teamItems.value.detailAreas);
  formData.append("active_date", teamItems.value.activeDate);
  formData.append("active_date_detail", teamItems.value.activeDateDetail);
  formData.append("team_url", teamItems.value.teamUrl);
  formData.append("schedule", teamItems.value.schedule);

  const imageData = new FormData();
  gallery.getPostImages.forEach((image) => {
    imageData.append("images[]", image);
  });

  // console.log(...formData.entries());
  // console.log(...teamData.entries());
  console.log(...imageData.entries());

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
    teamItems.value.itemId = res[0].data.value;
    return flashMessage.setMessage(Message.REGISTER);
  });
};
// console.log(teamItems.value.header_img);

const handleUpdate = async () => {
  const formData = new FormData();

  formData.append("header_img", teamItems.value.headerImg);
  formData.append("thumbnail", teamItems.value.thumbnail);
  formData.append("introduction", teamItems.value.introduction);
  formData.append("team_name", teamItems.value.teamName);
  formData.append("average", teamItems.value.average);
  formData.append("from_age", teamItems.value.fromAge);
  formData.append("to_age", teamItems.value.toAge);
  const rides = teamItems.value.rides;
  rides.forEach((ride) => {
    formData.append("rides[]", ride);
  });
  formData.append("detail_activities", teamItems.value.detailActivities);
  const areas = teamItems.value.areas;
  areas.forEach((area) => {
    formData.append("areas[]", area);
  });
  formData.append("detail_areas", teamItems.value.detailAreas);
  formData.append("active_date", teamItems.value.activeDate);
  formData.append("active_date_detail", teamItems.value.activeDateDetail);
  formData.append("team_url", teamItems.value.teamUrl);
  formData.append("schedule", teamItems.value.schedule);

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
    teamItems.value.itemId = res[0].data.value;
    return flashMessage.setMessage(Message.UPDATE);
  });
};

const handleCheck = async () => {
  if (deleteCheck) {
    await useApiFetch("/sanctum/csrf-cookie");
    await Promise.all([
      await useApiFetch(`/api/team/${teamItems.value.itemId}`, {
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
  const fieldArray = [teamItems.value.teamName, teamItems.value.introduction];

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
  const userId = auth.user.id;


  if (userId) {
    const res = await useApiFetch(`/api/team/${userId}`);
    if (res.error.value == null) {
      const val = res.data.value;
      console.log(val);
      if (val != null) {
        if (val.teamInfo) {
          teamItems.value.itemId = val.teamInfo.id;
          teamItems.value.urlHeaderImg =
            config.public.baseURL + "/storage/" + val.teamInfo.header_img_path;
          teamItems.value.urlThumbnail =
            config.public.baseURL + "/storage/" + val.teamInfo.thumbnail_path;
          teamItems.value.teamName = val.teamInfo.team_name;
          teamItems.value.memberCount = val.teamInfo.member;
          teamItems.value.introduction = val.teamInfo.introduction;
          teamItems.value.average = val.teamInfo.average;
          teamItems.value.fromAge = val.teamInfo.from_age;
          teamItems.value.toAge = val.teamInfo.to_age;
          teamItems.value.detailAreas = val.teamInfo.detail_areas;
          teamItems.value.detailActivities = val.teamInfo.detail_activities;
          teamItems.value.activeDate = val.teamInfo.active_date;
          teamItems.value.activeDateDetail = val.teamInfo.active_date_detail;
          teamItems.value.teamUrl = val.teamInfo.team_url;
          teamItems.value.schedule = val.teamInfo.schedule;
          teamItems.value.userId = val.teamInfo.user_id;
        }
        if (val.members) {
          teamItems.value.memberCount = val.members.length;
        }
        if (val.rides) {
          console.log(val.rides);
          val.rides.forEach((ride) => {
            teamItems.value.rides.push(ride.name);
          });
        }
        if (val.areas) {
          console.log(val.areas);
          val.areas.forEach((area) => {
            teamItems.value.areas.push(area.name);
          });
        }
      }
    }
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
