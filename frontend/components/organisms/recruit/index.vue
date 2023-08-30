<template>
  <form>
    <div class="relative z-0 h-[100px]">
      <AtomsImgsCardHeaderImg
        @emitInput = 'receiveImg'
        :path="recruit.getRecruitHeaderUrl"
        >
        <AtomsImgsThumbnail
        @emitInput = 'receiveThumbnail'
        :path="recruit.getRecruitThumbnailUrl"
        />
      </AtomsImgsCardHeaderImg>
    </div>
    <v-card-title class="w-60 text-body-2 text-left ml-auto">
      <AtomsInput
      class="pl-2 leading-snug relative before:absolute before:left-0 before:top-0 before:h-full before:w-[3px] before:bg-orange-600 z-100"
      placeholder="チーム名"
      type="text"
      @emitInput="receiveTeamName"
      :val="recruit.getRecruitTitle"
      />
    </v-card-title>
    <v-card-text>
      <AtomsTextAreas
      placeholder="本文"
      @emitInput="receiveTeamIntroduce"
      :body="recruit.getRecruitText"
      />
    </v-card-text>
    <AtomsBtnsBaseBtn
      width="16rem"
      class="my-4 d-block mx-auto"
      @click="handleRegister"
      :disabled="!checkFilledOut()"
      v-if="!recruit.getRecruitItemId"
    >
      登録
    </AtomsBtnsBaseBtn>
    <AtomsBtnsBaseBtn
      width="16rem"
      setColor="orange"
      class="my-4 d-block  mx-auto"
      @click="handleUpdate"
      :disabled="!checkFilledOut()"
      v-if="recruit.getRecruitItemId"
    >
      更新
    </AtomsBtnsBaseBtn>
    <AtomsBtnsBaseBtn
      width="16rem"
      setColor="red"
      class="my-4 d-block mx-auto"
      @click="handleDelete"
      v-if="recruit.getRecruitItemId"
    >
      削除
    </AtomsBtnsBaseBtn>
  </form>
</template>

<script setup lang="ts">
import { useRuntimeConfig,navigateTo } from "nuxt/app";
import { useApiFetch } from "../../../composables/useApiFetch";
import { ref, onMounted } from "vue";
import { Url } from "../../../constants/url";
import { useRecruitStore } from "../../../stores/useRecruitStore";
import { useAuthStore } from "../../../stores/useAuthStore";
import { onBeforeRouteUpdate } from "vue-router";
import {useRoute} from 'vue-router';

const auth = useAuthStore();
const router = useRoute();
const recruit = useRecruitStore();

const handleRegister = async () => {
  const formData = new FormData();

  formData.append("header_img", recruit.getRecruitHeaderImg);
  formData.append("thumbnail", recruit.getRecruitThumbnail);
  formData.append("title", recruit.getRecruitTitle);
  formData.append("text", recruit.getRecruitText);

  await recruit.registerRecruitItem(formData);

  return navigateTo({
    path:'/auth/user/recruit',
    query:{
      id:recruit.getRecruitItemId
    }
  })

}
const handleUpdate = async () => {
  const formData = new FormData();

  formData.append("header_img", recruit.getRecruitHeaderImg);
  formData.append("thumbnail", recruit.getRecruitThumbnail);
  formData.append("title", recruit.getRecruitTitle);
  formData.append("text", recruit.getRecruitText);

  const id = recruit.getRecruitItemId;
  await recruit.updateRecruitItem(formData, id);

};
const handleDelete = async () => {
  const id = recruit.getRecruitItemId;
  await recruit.deleteRecruitItem(id);
};

onMounted(async () => {
  const itemId = recruit.getRecruitItemId;
    await recruit.fetchRecruitItem(itemId);
});

const checkFilledOut = () => {
  const fieldArray = [
    recruit.getRecruitTitle,
    recruit.getRecruitText
  ];

  if (fieldArray.indexOf("") === -1) {
    return true;
  }

  return false;
};

const receiveImg = (val) => {
      recruit.header_img = val.files[0];
      recruit.url_header_img = URL.createObjectURL(recruit.header_img);
}

const receiveThumbnail = (val) => {
      recruit.thumbnail = val.files[0];
      recruit.url_thumbnail = URL.createObjectURL(recruit.thumbnail);
}
const receiveTeamName = (val) =>{
  recruit.title = val.value;
}
const receiveTeamIntroduce = (val) =>{
  recruit.text = val.value;
}

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
