<template>
  <form>
    <AtomsDisplayFlashMessage
    :isShow="isShow"
    >
    {{ flashMessage }}
  </AtomsDisplayFlashMessage>
    <OrganismsImgsCardProfile
      @emitInput="receiveProfileImage"
      :path_header="recruitItems.url_header_img"
      :path_thumbnail="recruitItems.url_thumbnail"
    />
    <v-card-title class="w-60 text-body-2 text-left ml-auto">
      <AtomsTextsHeadLine
      class="w-100"
      >
        <AtomsInput
          placeholder="チーム名"
          type="text"
          @emitInput="receiveTeamName"
          :val="recruitItems.title"
        />
      </AtomsTextsHeadLine>
    </v-card-title>
    <v-card-text>
      <AtomsTextAreas
        placeholder="チーム紹介"
        @emitInput="receiveTeamIntroduce"
        :body="recruitItems.text"
      />
    </v-card-text>
    <OrganismsAuthRecruitTeamInfo/>
    <v-container>
      <AtomsTextsHeadLine> チーム活動内容 </AtomsTextsHeadLine>
      <AtomsTextAreas
      placeholder="活動内容の詳細を記入"
      @emitInput="receiveTeamActivities"
      :body="recruitItems.activities"
      class="mt-2"
      />
    </v-container>
    <v-container>
      <AtomsTextsHeadLine> ギャラリー </AtomsTextsHeadLine>
      <OrganismsDrugAndDrop @emitImages="receiveImage" />
      <OrganismsGallery :images="displayImages" @emitClick="receiveClick" />
    </v-container>
    <AtomsBtnsBaseBtn
      width="16rem"
      class="my-4 d-block mx-auto"
      @emitClick="handleRegister"
      v-if="!recruitItems.item_id"
    >
      登録
    </AtomsBtnsBaseBtn>

    <!-- <v-snackbar
      :timeout="2000"
      color="deep-purple-accent-4"
      elevation="2"
      location="top"
    >
      <template v-slot:activator="{props }">
        <AtomsBtnsBaseBtn
        width="16rem"
      class="my-4 d-block mx-auto"
      @emitClick="handleRegister"
      v-bind="props"
      v-if="!recruitItems.item_id"
        >
          登録
        </AtomsBtnsBaseBtn>
      </template>

      Snackbar with <strong>elevation="24"</strong>.
    </v-snackbar> -->
    <AtomsBtnsBaseBtn
      width="16rem"
      setColor="orange"
      class="my-4 d-block mx-auto"
      @click.once="handleUpdate"
      :disabled="!checkFilledOut()"
      v-if="recruitItems.item_id"
    >
      更新
    </AtomsBtnsBaseBtn>
    <OrganismsModal
      v-if="recruitItems.item_id"
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
import {Message} from '~/constants/flashMessage';
import { useApiFetch } from "~/composables/useApiFetch";
import { ref, onBeforeMount, computed } from "#imports";
import { Url } from "~/constants/url";
import { useAuthStore } from "~/stores/useAuthStore";
// import { useRoute } from "vue-router";

const auth = useAuthStore();
const config = useRuntimeConfig();

const postImages = ref([]);
const displayImages = ref([]);
const deleteCheck = ref(false);
const isShow = ref(false);
const flashMessage = ref('');

const handelDelete = computed(()=>{
  return deleteCheck.value = true;
})
const recruitItems = ref({
  items: [],
  item: "",
  itemCount: 0,
  path_header: "",
  path_thumbnail: "",
  item_id: "",
  user_id: "",
  header_img: "",
  thumbnail: "",
  title: "",
  text: "",
  activities:'',
  url_header_img: config.public.appURL + "/images/noimage.jpg",
  url_thumbnail: config.public.appURL + "/images/noimage.jpg",
});




const handleRegister = async() => {
  flashMessage.value = Message.REGISTER;
  isShow.value = true;

  const formData = new FormData();

  formData.append("header_img", recruitItems.value.header_img);
  formData.append("thumbnail", recruitItems.value.thumbnail);
  formData.append("title", recruitItems.value.title);
  formData.append("text", recruitItems.value.text);
  formData.append("activities", recruitItems.value.activities);

  const imageData = new FormData();
  postImages.value.forEach((image) => {
    imageData.append("images[]", image);
  });
  console.log(...formData.entries());
  console.log(...imageData.entries());

  await useApiFetch("/sanctum/csrf-cookie");
  await Promise.all([
    useApiFetch("/api/recruit/register", {
      method: "POST",
      body: formData,
    }),
    useApiFetch("/api/images/register", {
      method: "POST",
      body: imageData,
    }),
  ]).then((res) => {
    // console.log("all", res);
    // console.log(res[0].data.value);
    isShow.value = true;
    console.log(isShow.value);
    recruitItems.value.item_id = res[0].data.value;

  });

  // isShow.value=false;

};
// console.log(recruitItems.value.header_img);

const handleUpdate = async () => {
  const formData = new FormData();

  formData.append("header_img", recruitItems.value.header_img);
  formData.append("thumbnail", recruitItems.value.thumbnail);
  formData.append("title", recruitItems.value.title);
  formData.append("text", recruitItems.value.text);
  formData.append("activities", recruitItems.value.activities);

  const imageData = new FormData();
  postImages.value.forEach((image) => {
    imageData.append("images[]", image);
  });
  // imageData.append('test','test');

  // console.log(...imageData.entries());

  await useApiFetch("/sanctum/csrf-cookie");
  await Promise.all([
    useApiFetch(`/api/recruit/${auth.user.id}`, {
      method: "POST",
      body: formData,
      headers: {
        "X-HTTP-Method-Override": "PUT",
      },
    }),
    useApiFetch(`/api/images/${auth.user.id}`, {
      method: "POST",
      body: imageData,
      headers: {
        "X-HTTP-Method-Override": "PUT",
      },
    }),
  ]).then((res) => {
    console.log("all", res);
  });
  return navigateTo(Url.AUTHRECRUIT);
};

const handleCheck = async()=>{
  flashMessage.value = Message.DELETE;
  if(deleteCheck) {
    await useApiFetch("/sanctum/csrf-cookie");
    await Promise.all([
      await useApiFetch(`/api/recruit/${recruitItems.value.item_id}`, {
        method: "DELETE",
      }),
      await useApiFetch(`/api/images/${auth.user.id}`, {
        method: "DELETE",
      }),
    ]).then((res) => {
      console.log(res);
      isShow.value = true;
    });

    return navigateTo(Url.AUTHRECRUIT);
  }
}

const checkFilledOut = () => {
  const fieldArray = [recruitItems.value.title, recruitItems.value.text];

  if (fieldArray.indexOf("") === -1) {
    return true;
  }
  return false;
};

const receiveImage = (val) => {
  Array.from(val.files).map((data) => {
      postImages.value.push(data);
      let image = window.URL.createObjectURL(data);
      displayImages.value.push(image);
    });
};

const receiveClick = (val) => {
  displayImages.value.splice(val, 1);
  postImages.value.splice(val, 1);
};

const receiveTeamName = (val) => {
  recruitItems.value.title = val.value;
};
const receiveTeamIntroduce = (val) => {
  recruitItems.value.text = val.value;
};
const receiveTeamActivities = (val) => {
  recruitItems.value.activities = val.value;
};

const receiveProfileImage = (val: File) => {
  if (val.target == "header") {
    recruitItems.value.header_img = val.val;
    recruitItems.value.url_header_img = URL.createObjectURL(val.val);
  } else {
    recruitItems.value.thumbnail = val.val;
    recruitItems.value.url_thumbnail = URL.createObjectURL(val.val);
  }
  URL.revokeObjectURL(val.val);
};

// const deleteItem = () => {
//   toggleDelete.value = !toggleDelete.value;
// };

onBeforeMount(async () => {
  const userId = auth.user.id;
  console.log(userId);
  if (userId) {
    await Promise.all([
      useApiFetch(`/api/recruit/${userId}`),
      useApiFetch(`/api/images/${userId}`),
    ]).then((responses) => {
      console.log(responses);
      responses.forEach((res) => {
        console.log(res);
        const val = res.data.value;
        console.log(res.data);
        if (val.data) {
          recruitItems.value.item_id = val.data.id;
          recruitItems.value.url_header_img =
            config.public.baseURL + "/storage/" + val.data.header_img_path;
          recruitItems.value.url_thumbnail =
            config.public.baseURL + "/storage/" + val.data.thumbnail_path;
          recruitItems.value.title = val.data.title;
          recruitItems.value.text = val.data.text;
          recruitItems.value.activities = val.data.activities;
          recruitItems.value.user_id = val.data.user_id;
        } else {
          if (val.images) {
            val.images.forEach((image) => {
              postImages.value.push(image);
              displayImages.value.push(
                config.public.baseURL + "/storage/" + image
              );
            });
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
