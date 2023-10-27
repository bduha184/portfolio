<template>
  <form>
    <OrganismsImgsCardProfile
      @emitInput="receiveProfileImage"
      :path_header="form.url_header_img"
      :path_thumbnail="form.url_thumbnail"
    />
    <v-card-title class="w-60 text-body-2 text-left ml-auto">
      <AtomsTextsHeadLine>
        {{ auth.user.name }}
      </AtomsTextsHeadLine>
    </v-card-title>
    <v-card-text>
      <AtomsTextAreas
        placeholder="本文"
        @emitInput="receiveTeamIntroduce"
        :body="form.introduction"
      />
    </v-card-text>
    <AtomsBtnsBaseBtn
      width="16rem"
      class="my-4 d-block mx-auto"
      @click.once="handleRegister"
      :disabled="!checkFilledOut()"
      v-if="!form.item_id"
    >
      登録
    </AtomsBtnsBaseBtn>
    <AtomsBtnsBaseBtn
      width="16rem"
      setColor="orange"
      class="my-4 d-block mx-auto"
      @click.once="handleUpdate"
      :disabled="!checkFilledOut()"
      v-if="form.item_id"
    >
      更新
    </AtomsBtnsBaseBtn>
    <AtomsBtnsBaseBtn
      width="16rem"
      setColor="red"
      class="my-4 d-block mx-auto"
      @click="handleDelete"
      v-if="form.item_id"
    >
      削除
    </AtomsBtnsBaseBtn>
  </form>
</template>

<script setup lang="ts">
import { ref, onMounted } from "#imports";
import { useRuntimeConfig, navigateTo } from "nuxt/app";
import { useApiFetch } from "~/composables/useApiFetch";
import { Url } from "~/constants/url";
import { useAuthStore } from "~/stores/useAuthStore";
import { useRoute } from "vue-router";

const auth = useAuthStore();
const config = useRuntimeConfig();
const router = useRoute();

const form = ref({
  path_header: "",
  path_thumbnail: "",
  user_id: '',
  header_img: "",
  thumbnail: "",
  introduction: "",
  item_id:"",
  url_header_img: config.public.appURL + "/images/noimage.jpg",
  url_thumbnail: config.public.appURL + "/images/noimage.jpg",
});

const handleRegister = async () => {
  const formData = new FormData();

  formData.append("header_img", form.value.header_img);
  formData.append("thumbnail", form.value.thumbnail);
  formData.append("introduction", form.value.introduction);

  // console.log(...data.entries());
  await useApiFetch("/sanctum/csrf-cookie");
  const res = await useApiFetch("/api/profile/register", {
    method: "POST",
    body: formData,
  });
  form.value.item_id = res.data.value.item_id;
  form.value.path_header = res.data.value.path_header;
  form.value.path_thumbnail = res.data.value.path_thumbnail;
  form.value.introduction = res.data.value.introduction;

  return navigateTo(Url.AUTHPROFILE);
};

const handleUpdate = async () => {
  const formData = new FormData();

  formData.append("header_img", form.value.header_img);
  formData.append("thumbnail", form.value.thumbnail);
  formData.append("introduction", form.value.introduction);

  const userId = auth.user.id;
  await useApiFetch("/sanctum/csrf-cookie");
  const res = await useApiFetch(`/api/profile/${userId}`, {
    method: "POST",
    body: formData,
    headers: {
      "X-HTTP-Method-Override": "PUT",
    },
  });

  form.value.path_header = res.data.value.path_header;
  form.value.path_thumbnail = res.data.value.path_thumbnail;
};
const handleDelete = async () => {
  const itemId = form.value.item_id;
  await useApiFetch("/sanctum/csrf-cookie");
  const res = await useApiFetch(`/api/profile/${itemId}`, {
    method: "DELETE",
  });
};



const checkFilledOut = () => {
  const fieldArray = [form.value];

  if (fieldArray.indexOf("") === -1) {
    return true;
  }

  return false;
};


const receiveProfileImage = (val: File) => {
  if (val.target == "header") {
    form.value.header_img = val.val;
    form.value.url_header_img = URL.createObjectURL(val.val);
  } else {
    form.value.thumbnail = val.val;
    form.value.url_thumbnail = URL.createObjectURL(val.val);
  }
  URL.revokeObjectURL(val.val);
};
const receiveTeamIntroduce = (val) => {
  form.value.introduction = val.value;
};


onMounted(async () => {
  const userId = auth.user.id;
  if (userId != 0) {
    const res = await useApiFetch(`/api/profile/${userId}`);
    const val = res.data.value;
    if(val.data != null){
      form.value.url_header_img =
        config.public.baseURL + "/storage/" + val.data.header_img_path;
      form.value.url_thumbnail =
        config.public.baseURL + "/storage/" + val.data.thumbnail_path;
      form.value.introduction = val.data.introduction;
      form.value.user_id = val.data.user_id;
      form.value.item_id = val.data.id;
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
