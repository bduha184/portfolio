<template>
  <v-container>
    <h1 class="text-h6 font-weight-bold text-center">
      メンバー募集の管理ページ
    </h1>
    <v-card>
    <form>
        <div
        class="relative z-0 h-[100px]"
        >
          <v-img
          :src="recruit.getRecruitHeaderUrl" cover>
            <v-avatar size="80">
              <v-img :src="recruit.getRecruitThumbnailUrl" cover />
              <v-file-input
              variant="solo"
              name="thumbnail"
              @change="onChange"
              />
            </v-avatar>
          </v-img>
          <v-file-input
          variant="solo"
          name="header_img"
          @change="onChange"
          />
        </div>
        <v-card-title class="w-60 text-body-2 text-left ml-auto">
            <v-text-field
            variant="outlined"
            v-model="recruit.title"
            label="チーム名"
            single-line
            hide-details
            density="compact"
            class="pl-2 leading-snug relative before:absolute before:left-0 before:top-0 before:h-full before:w-[3px] before:bg-orange-600 z-100"
            />
        </v-card-title>
        <v-card-text>
          <v-textarea
          single-line
          hide-details
          variant="outlined" label="本文"
          v-model="recruit.text"
          />
        </v-card-text>
        <ButtonCommon
        btnValue="登録"
        width="16rem"
        class="my-4 d-block"
        @click="handleRegister"
        :disabled="!checkFilledOut()"
        v-if="!recruit.getRecruitItemId"
        />
        <ButtonCommon
        btnValue="更新"
        width="16rem"
        setColor="orange"
        class="my-4 d-block"
        @click="handleUpdate"
        :disabled="!checkFilledOut()"
        v-if="recruit.getRecruitItemId"
        />
        <ButtonCommon
        btnValue="削除"
        width="16rem"
        setColor="red"
        class="my-4 d-block"
        @click="handleDelete"
        v-if="recruit.getRecruitItemId"
        />
      </form>
    </v-card>
  </v-container>
</template>

<script setup lang="ts">
import { useRuntimeConfig } from "nuxt/app";
import { definePageMeta } from "#imports";
import { useApiFetch } from "../../composables/useApiFetch";
import { ref,onMounted } from "vue";
import { Url } from "../../constants/url";
import {useRoute} from 'vue-router';
import {navigateTo} from 'nuxt/app';
import {useRecruitStore} from '../../stores/useRecruitStore';
import { useAuthStore } from "../../stores/useAuthStore";

definePageMeta({
  middleware: ["auth"],
});

const auth = useAuthStore();

const recruit = useRecruitStore();

const onChange = (e) => {
  const target = e.target.name;
  if (target == "header_img") {
    recruit.header_img = e.target.files[0];
    recruit.url_header_img = URL.createObjectURL(recruit.header_img);
  } else {
    recruit.thumbnail = e.target.files[0];
    recruit.url_thumbnail = URL.createObjectURL(recruit.thumbnail);
  }
};


const handleRegister = async () => {
  const formData = new FormData();

  formData.append("header_img", recruit.getRecruitHeaderImg);
  formData.append("thumbnail", recruit.getRecruitThumbnail);
  formData.append("title", recruit.getRecruitTitle);
  formData.append("text", recruit.getRecruitText);

  await recruit.registerRecruitItem(formData);

  return navigateTo(Url.AUTHRECRUIT);
};

const handleUpdate = async () => {
  // console.log(recruit.getRecruitHeaderImg);
  // console.log(recruit.getRecruitThumbnail);
  // console.log(recruit.getRecruitTitle);
  // console.log(recruit.getRecruitText);
  const formData = new FormData();

  formData.append("header_img", recruit.getRecruitHeaderImg);
  formData.append("thumbnail", recruit.getRecruitThumbnail);
  formData.append("title", recruit.getRecruitTitle);
  formData.append("text", recruit.getRecruitText);

  const id = recruit.getRecruitItemId;
  await recruit.updateRecruitItem(formData,id);

  return navigateTo(Url.AUTHRECRUIT);
};
const handleDelete = async()=> {
  await recruit.deleteRecruitItem(recruit.id);
}



onMounted(async ()=>{
  const user = auth.user;
    await recruit.fetchRecruitItem(user.id);

})

const checkFilledOut = () => {

const fieldArray = [
  recruit.getRecruitTitle,
  recruit.getRecruitText
]

if(fieldArray.indexOf('') === -1) {
  return true;
}

return false
}

</script>

<style lang="scss" scoped>
.v-card {
  overflow: hidden !important;
  border-radius: 10px;
}
  .v-avatar {
    position:absolute !important;
    bottom:-40px;
    left:20px;
    z-index: 1;
  }

  .v-responsive {
  position: unset !important;
}
.v-file-input {
  opacity: 0;
  position:absolute !important;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  width: 100%;
  height: 100%;
  z-index: 10;
  background: red;
}
</style>
