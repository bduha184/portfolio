<template>
  <form>
    <OrganismsImgsCardProfile
      @emitInput="receiveProfileImage"
      :pathHeader="prof.getProf.urlHeaderImg"
      :pathThumbnail="prof.getProf.urlThumbnail"
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
        :body="prof.getProf.introduction"
      />
    </v-card-text>
    <AtomsBtnsBaseBtn
      width="16rem"
      class="my-4 d-block mx-auto"
      @click.once="handleRegister"
      :disabled="checkFilledOut"
      color="info"
      v-if="!prof.getProf.itemId"
    >
      登録
    </AtomsBtnsBaseBtn>
    <AtomsBtnsBaseBtn
      width="16rem"
      color="orange"
      class="my-4 d-block mx-auto"
      @click.once="handleUpdate"
      :disabled="checkFilledOut"
      v-if="prof.getProf.itemId"
    >
      更新
    </AtomsBtnsBaseBtn>
    <OrganismsModal
      v-if="prof.getProf.itemId"
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
import { useProfileStore } from "~/stores/useProfileStore";
import { useFlashMessageStore } from "~/stores/useFlashMessageStore";
const auth = useAuthStore();
const prof  = useProfileStore();
const flashMessage = useFlashMessageStore();

const handleRegister = async () => {
  const formData = new FormData();

  formData.append("header_img", prof.getProf.pathHeader);
  formData.append("thumbnail", prof.getProf.pathThumbnail);
  formData.append("introduction", prof.getProf.introduction);

  // console.log(...formData.entries());
  await useApiFetch("/sanctum/csrf-cookie");
  const res = await useApiFetch("/api/profile/register", {
    method: "POST",
    body: formData,
  });
  if (res.error.value == null) {

    prof.setValue(res.data.value);
    return flashMessage.setMessage(Message.REGISTER);
  }
  return flashMessage.setMessage(Message.REGISTERERROR, "error", 6000);
};

const handleUpdate = async () => {
  const formData = new FormData();

  formData.append("header_img", prof.getProf.pathHeader);
  formData.append("thumbnail", prof.getProf.pathThumbnail);
  formData.append("introduction", prof.getProf.introduction);

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
    prof.setValue(res.data.value);
    return flashMessage.setMessage(Message.UPDATE);
  }
  return flashMessage.setMessage(Message.UPDATEERROR, "error", 6000);
};
const handleDelete = async () => {
  const itemId = prof.getProf.itemId;
  await useApiFetch("/sanctum/csrf-cookie");
  const {error} = await useApiFetch(`/api/profile/${itemId}`, {
    method: "DELETE",
  });
  if (error.value == null) {
    flashMessage.setMessage(Message.DELETE);
    prof.deleteValue();
    return navigateTo(Url.MYPAGE);
  }
  return flashMessage.setMessage(Message.DELETEERROR, "error", 6000);
};

const checkFilledOut = computed(() => {
  console.log(prof.getProf.introduction);
  if(prof.getProf.introduction) {
    return false;
  }
  return true;
});


const receiveProfileImage = (val: File) => {
  prof.setValue(val);

};
const receiveTeamIntroduce = (val) => {
  prof.setValue(val);
};

onMounted(() => {
  prof.fetchProfile(auth.user.id);
  console.log(prof.getProf)
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
