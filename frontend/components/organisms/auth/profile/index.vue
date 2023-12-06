<template>
  <form>
    <OrganismsImgsCardProfile
      @emitInput="receiveProfileImage"
      :pathHeader="form.urlHeaderImg"
      :pathThumbnail="form.urlThumbnail"
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
      color="info"
      v-if="!form.itemId"
    >
      登録
    </AtomsBtnsBaseBtn>
    <AtomsBtnsBaseBtn
      width="16rem"
      color="orange"
      class="my-4 d-block mx-auto"
      @click.once="handleUpdate"
      :disabled="!checkFilledOut()"
      v-if="form.itemId"
    >
      更新
    </AtomsBtnsBaseBtn>
    <OrganismsModal
      v-if="form.itemId"
      @emitModalOpen="handleCheck"
      @emitModalBtnClick="handleDelete"
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
import { useApiFetch } from "~/composables/useApiFetch";
import { Url } from "~/constants/url";
import { Message } from "~/constants/flashMessage";
import { useAuthStore } from "~/stores/useAuthStore";
import { useFlashMessageStore } from "~/stores/useFlashMessageStore";

const auth = useAuthStore();
const config = useRuntimeConfig();
const flashMessage = useFlashMessageStore();

const form = ref({
  pathHeader: "",
  pathThumbnail: "",
  userId: "",
  headerImg: "",
  thumbnail: "",
  introduction: "",
  itemId: "",
  urlHeaderImg: config.public.appURL + "/images/noimage.jpg",
  urlThumbnail: config.public.appURL + "/images/noimage.jpg",
});

const handleRegister = async () => {
  const formData = new FormData();

  formData.append("header_img", form.value.headerImg);
  formData.append("thumbnail", form.value.thumbnail);
  formData.append("introduction", form.value.introduction);

  // console.log(...data.entries());
  await useApiFetch("/sanctum/csrf-cookie");
  const res = await useApiFetch("/api/profile/register", {
    method: "POST",
    body: formData,
  });
  if (res.error.value == null) {
    form.value.itemId = res.data.value.item_id;
    form.value.pathHeader = res.data.value.path_header;
    form.value.pathThumbnail = res.data.value.path_thumbnail;
    form.value.introduction = res.data.value.introduction;
    return flashMessage.setMessage(Message.REGISTER);
  }
  return flashMessage.setMessage(Message.REGISTERERROR, "error", 6000);
};

const handleUpdate = async () => {
  const formData = new FormData();

  formData.append("header_img", form.value.headerImg);
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

  if (res.error.value == null) {
    form.value.pathHeader = res.data.value.path_header;
    form.value.pathThumbnail = res.data.value.path_thumbnail;

    return flashMessage.setMessage(Message.UPDATE);
  }
  return flashMessage.setMessage(Message.UPDATEERROR, "error", 6000);
};
const handleDelete = async () => {
  const itemId = form.value.itemId;
  await useApiFetch("/sanctum/csrf-cookie");
  const res = await useApiFetch(`/api/profile/${itemId}`, {
    method: "DELETE",
  });
  if (res.error.value == null) {
    flashMessage.setMessage(Message.DELETE);
    return navigateTo(Url.MYPAGE);
  }
  return flashMessage.setMessage(Message.DELETEERROR, "error", 6000);
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
    form.value.headerImg = val.val;
    form.value.urlHeaderImg = URL.createObjectURL(val.val);
  } else {
    form.value.thumbnail = val.val;
    form.value.urlThumbnail = URL.createObjectURL(val.val);
  }
  // URL.revokeObjectURL(val.val);
};
const receiveTeamIntroduce = (val) => {
  form.value.introduction = val.value;
};

console.log(auth.user.id);

onMounted(async () => {
  const userId = auth.user.id;
  if (userId) {
    const res = await useApiFetch(`/api/profile/${userId}`);
    const val = res.data.value;
    if (val.data != null) {
      form.value.urlHeaderImg = config.public.baseURL + "/storage/" + val.data.header_img_path;
      form.value.urlThumbnail =  config.public.baseURL + "/storage/" + val.data.thumbnail_path;
      form.value.introduction = val.data.introduction;
      form.value.userId = val.data.user_id;
      form.value.itemId = val.data.id;
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
