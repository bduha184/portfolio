<template>
  <form>
    <OrganismsImgsCardProfile
      @emitInput="receiveProfileImage"
      :path_header="teamItems.url_header_img"
      :path_thumbnail="teamItems.url_thumbnail"
    />
    <v-card-title class="w-60 text-body-2 text-left ml-auto">
      <AtomsTextsHeadLine class="w-100">
        <AtomsInput
          placeholder="チーム名"
          type="text"
          @emitInput="receiveTeamName"
          :val="teamItems.team_name"
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
      <OrganismsGallery :images="gallery.getDisplayImages" @emitClick="receiveClick" />
    </v-container>
    <OrganismsAuthRecruitTeamInfo
      @emitAgeAverage="receiveAverage"
      @emitFromAge="receiveFromAge"
      @emitToAge="receiveToAge"
      @emitTags="receiveTags"
      @emitAreas="receiveAreas"
      @emitDetailAreas="receiveDetailAreas"
      @emitDetailActivities="receiveDetailActivities"
      @emitActiveDateTime="receiveActiveDateTime"
      @emitTeamUrl="receiveTeamUrl"
      :member_count="teamItems.member_count"
      :average="teamItems.average"
      :from_age="teamItems.from_age"
      :to_age="teamItems.to_age"
      :tags="teamItems.tags"
      :areas="teamItems.areas"
      :detailActivities="teamItems.detailActivities"
      :detailAreas="teamItems.detailAreas"
      :activeDateTime="teamItems.activeDateTime"
      :teamUrl="teamItems.teamUrl"
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
      class="my-4 d-block mx-auto"
      @emitClick="handleRegister"
      v-if="!teamItems.item_id"
    >
      登録
    </AtomsBtnsBaseBtn>
    <AtomsBtnsBaseBtn
      width="16rem"
      setColor="orange"
      class="my-4 d-block mx-auto"
      @click.once="handleUpdate"
      :disabled="!checkFilledOut()"
      v-if="teamItems.item_id"
    >
      更新
    </AtomsBtnsBaseBtn>
    <OrganismsModal
      v-if="teamItems.item_id"
      @emitModalOpen="handleCheck"
      @emitModalBtnClick="handleDelete"
      setColor="red"
      caution="※削除すると元に戻せなくなります。削除しますか？"
      btnValue="削除する"
      btnType="delete"
    >
      削除
    </OrganismsModal>
  </form>
</template>

<script setup lang="ts">
import {
  useRuntimeConfig,
  navigateTo,
  useRoute,
  clearNuxtData,
} from "nuxt/app";
import { Message } from "~/constants/flashMessage";
import { ref, onBeforeMount, computed, watch } from "#imports";
import { Url } from "~/constants/url";
import { useApiFetch } from "~/composables/useApiFetch";
import { useAuthStore } from "~/stores/useAuthStore";
import { useFlashMessageStore } from "~/stores/useFlashMessageStore";
import { Form } from "vee-validate";
import { useGalleryStore } from "~/stores/useGalleryStore";
import vueGalleryClient from "../../../../plugins/vue-gallery.client";

const config = useRuntimeConfig();
const auth = useAuthStore();
const flashMessage = useFlashMessageStore();
const gallery = useGalleryStore();

const postImages = ref([]);
const deleteCheck = ref(false);
const handelDelete = computed(() => {
  return (deleteCheck.value = true);
});

const teamItems = ref({
  path_header: "",
  path_thumbnail: "",
  item_id: "",
  user_id: "",
  header_img: "",
  thumbnail: "",
  team_name: "",
  average: "",
  from_age: "",
  to_age: "",
  tags: [],
  areas: [],
  detailAreas: "",
  introduction: "",
  member_count: 0,
  detailActivities: "",
  schedule: "",
  activeDateTime: "",
  teamUrl: "",
  url_header_img: config.public.appURL + "/images/noimage.jpg",
  url_thumbnail: config.public.appURL + "/images/noimage.jpg",
});

const receiveClick = (val) => {
  gallery.deleteImages(val);
};

const receiveTeamName = (val) => {
  teamItems.value.team_name = val.value;
};

const receiveTeamIntroduce = (val) => {
  teamItems.value.introduction = val.value;
};

const receiveTeamSchedule = (val) => {
  teamItems.value.schedule = val.value;
};

const receiveProfileImage = (val: File) => {
  if (val.target == "header") {
    teamItems.value.header_img = val.val;
    teamItems.value.url_header_img = URL.createObjectURL(val.val);
  } else {
    teamItems.value.thumbnail = val.val;
    teamItems.value.url_thumbnail = URL.createObjectURL(val.val);
  }
  // URL.revokeObjectURL(val.val);
};

const receiveAverage = (val) => {
  teamItems.value.average = val;
};
const receiveFromAge = (val) => {
  teamItems.value.from_age = val;
};
const receiveToAge = (val) => {
  teamItems.value.to_age = val;
};
const receiveTags = (val) => {
  teamItems.value.tags = val;
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

const receiveActiveDateTime = (val) => {
  teamItems.value.activeDateTime = val;
};

const handleRegister = async () => {
  const formData = new FormData();

  formData.append("header_img", teamItems.value.header_img);
  formData.append("thumbnail", teamItems.value.thumbnail);
  formData.append("introduction", teamItems.value.introduction);
  formData.append("team_name", teamItems.value.team_name);
  formData.append("average", teamItems.value.average);
  formData.append("from_age", teamItems.value.from_age);
  formData.append("to_age", teamItems.value.to_age);
  const tags = teamItems.value.tags;
  tags.forEach((tag) => {
    formData.append("tags[]", tag);
  });
  formData.append("detailActivities", teamItems.value.detailActivities);
  const areas = teamItems.value.areas;
  areas.forEach((area) => {
    formData.append("areas[]", area);
  });
  formData.append("detailAreas", teamItems.value.detailAreas);
  formData.append("activeDateTime", teamItems.value.activeDateTime);
  formData.append("teamUrl", teamItems.value.teamUrl);
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
    // useApiFetch("/api/team/register", {
    //   method: "POST",
    //   body: formData,
    // }),
    useApiFetch("/api/image/register", {
      method: "POST",
      body: imageData,
    }),
  ]).then((res) => {
    console.log(res);
    if (res[0].error.value != null && res[0].error.value != null) {
      return flashMessage.setMessage(Message.REGISTERERROR, "error", 6000);
    }

    teamItems.value.item_id = res[0].data.value;
    return flashMessage.setMessage(Message.REGISTER);
  });
};
// console.log(teamItems.value.header_img);

const handleUpdate = async () => {
  const formData = new FormData();

  formData.append("header_img", teamItems.value.header_img);
  formData.append("thumbnail", teamItems.value.thumbnail);
  formData.append("introduction", teamItems.value.introduction);
  formData.append("team_name", teamItems.value.team_name);
  formData.append("average", teamItems.value.average);
  formData.append("from_age", teamItems.value.from_age);
  formData.append("to_age", teamItems.value.to_age);
  const tags = teamItems.value.tags;
  tags.forEach((tag) => {
    formData.append("tags[]", tag);
  });
  formData.append("detailActivities", teamItems.value.detailActivities);
  const areas = teamItems.value.areas;
  areas.forEach((area) => {
    formData.append("areas[]", area);
  });
  formData.append("detailAreas", teamItems.value.detailAreas);
  formData.append("activeDateTime", teamItems.value.activeDateTime);
  formData.append("teamUrl", teamItems.value.teamUrl);
  formData.append("schedule", teamItems.value.schedule);

  const imageData = new FormData();
  postImages.value.forEach((image) => {
    imageData.append("images[]", image);
  });
  //
  // console.log(...formData.entries());
  console.log(...imageData.entries());

  // await useApiFetch("/sanctum/csrf-cookie");
  // await Promise.all([
  //   useApiFetch(`/api/team/${auth.user.id}`, {
  //     method: "POST",
  //     body: formData,
  //     headers: {
  //       "X-HTTP-Method-Override": "PUT",
  //     },
  //   }),
  //   useApiFetch(`/api/image/${auth.user.id}`, {
  //     method: "POST",
  //     body: imageData,
  //     headers: {
  //       "X-HTTP-Method-Override": "PUT",
  //     },
  //   }),
  // ]).then((res) => {
  //   if (res[0].error.value != null && res[0].error.value != null) {
  //     return flashMessage.setMessage(Message.UPDATEERROR, "error", 6000);
  //   }

  //   teamItems.value.item_id = res[0].data.value;
  //   return flashMessage.setMessage(Message.UPDATE);
  // });
};

const handleCheck = async () => {
  if (deleteCheck) {
    await useApiFetch("/sanctum/csrf-cookie");
    await Promise.all([
      await useApiFetch(`/api/team/${teamItems.value.item_id}`, {
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
  const fieldArray = [teamItems.value.team_name, teamItems.value.introduction];

  if (fieldArray.indexOf("") === -1) {
    return true;
  }
  return false;
};

const receiveImage = (val) => {
  gallery.setImages(val.files)
};

// const displayImages = computed(()=>{
//   const baseUrl =  config.public.baseURL + "/storage/";
//   // gallery.getDisplayImages.forEach(image =>{

//   // })
// })

// const deleteItem = () => {
//   toggleDelete.value = !toggleDelete.value;
// };

onBeforeMount(async () => {
  const userId = auth.user.id;

  if (userId) {
    await Promise.all([
      useApiFetch(`/api/team/${userId}`),
      useApiFetch(`/api/image/${userId}`),
    ]).then((responses) => {
      responses.forEach((res) => {
        if (res.error.value == null) {
          const val = res.data.value;
          if (val != null) {
            if (val.teamItem) {
              teamItems.value.item_id = val.teamItem.id;
              teamItems.value.url_header_img =
                config.public.baseURL +
                "/storage/" +
                val.teamItem.header_img_path;
              teamItems.value.url_thumbnail =
                config.public.baseURL +
                "/storage/" +
                val.teamItem.thumbnail_path;
              teamItems.value.team_name = val.teamItem.team_name;
              teamItems.value.introduction = val.teamItem.introduction;
              teamItems.value.average = val.teamItem.average;
              teamItems.value.from_age = val.teamItem.from_age;
              teamItems.value.to_age = val.teamItem.to_age;
              teamItems.value.detailAreas = val.teamItem.detailAreas;
              teamItems.value.detailActivities = val.teamItem.detailActivities;
              teamItems.value.activeDateTime = val.teamItem.activeDateTime;
              teamItems.value.teamUrl = val.teamItem.teamUrl;
              teamItems.value.schedule = val.teamItem.schedule;
              teamItems.value.user_id = val.teamItem.user_id;
            }
            if (val.members) {
              teamItems.value.member_count = val.members.length + 1;
            }
            if (val.tags) {
              val.tags.forEach((tag) => {
                teamItems.value.tags.push(tag.name);
              });
            }
            if (val.areas) {
              val.areas.forEach((area) => {
                teamItems.value.areas.push(area.name);
              });
            }
          }
        }
      });
    });
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
