<template>
  <form>
    <div class="relative z-0 h-[100px]">
      <AtomsImgsCardHeaderImg
        @emitInput = 'receiveImg'
        :path="profile.getProfileHeaderUrl"
        >
        <AtomsImgsThumbnail
        @emitInput = 'receiveThumbnail'
        :path="profile.getProfileThumbnailUrl"
        />
      </AtomsImgsCardHeaderImg>
    </div>
    <v-card-title class="w-60 text-body-2 text-left ml-auto">
     <AtomsDecorationHeadline>
      {{ auth.user.name }}
     </AtomsDecorationHeadline>
    </v-card-title>
    <v-card-text>
      <AtomsTextAreas
      placeholder="本文"
      @emitInput="receiveTeamIntroduce"
      :body="profile.getProfileText"
      />
    </v-card-text>
    <AtomsBtnsBaseBtn
      width="16rem"
      class="my-4 d-block mx-auto"
      @click="handleRegister"
      :disabled="!checkFilledOut()"
      v-if="!profile.getProfileItemId"
    >
      登録
    </AtomsBtnsBaseBtn>
    <AtomsBtnsBaseBtn
      width="16rem"
      setColor="orange"
      class="my-4 d-block  mx-auto"
      @click="handleUpdate"
      :disabled="!checkFilledOut()"
      v-if="profile.getProfileItemId"
    >
      更新
    </AtomsBtnsBaseBtn>
    <AtomsBtnsBaseBtn
      width="16rem"
      setColor="red"
      class="my-4 d-block mx-auto"
      @click="handleDelete"
      v-if="profile.getProfileItemId"
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
import {useProfileStore} from '../../../stores/useProfileStore';
import { useAuthStore } from "../../../stores/useAuthStore";
import { onBeforeRouteUpdate } from "vue-router";
import {useRoute} from 'vue-router';

const auth = useAuthStore();

const router = useRoute();
const profile = useProfileStore();

const handleRegister = async () => {
  const formData = new FormData();

  formData.append("header_img", profile.getProfileHeaderImg);
  formData.append("thumbnail", profile.getProfileThumbnail);
  formData.append("text", profile.getProfileText);

  await profile.registerProfileItem(formData);

  return navigateTo({
    path:'/auth/user/profile',
    query:{
      id:profile.getProfileItemId
    }
  })

}


const handleUpdate = async () => {
  const formData = new FormData();

  formData.append("header_img", profile.getProfileHeaderImg);
  formData.append("thumbnail", profile.getProfileThumbnail);
  formData.append("text", profile.getProfileText);

  const id = profile.getProfileItemId;
  await profile.updateProfileItem(formData, id);

};
const handleDelete = async () => {
  const id = profile.getProfileItemId;
  await profile.deleteProfileItem(id);
};

onMounted(async () => {
  const itemId = profile.getProfileItemId;
  if(itemId!=0){

    await profile.fetchProfileItem(itemId);
  }
});


const checkFilledOut = () => {
  const fieldArray = [
    profile.getProfileText
  ];

  if (fieldArray.indexOf("") === -1) {
    return true;
  }

  return false;
};

const receiveImg = (val) => {
      profile.header_img = val.files[0];
      profile.url_header_img = URL.createObjectURL(profile.header_img);
}

const receiveThumbnail = (val) => {
      profile.thumbnail = val.files[0];
      profile.url_thumbnail = URL.createObjectURL(profile.thumbnail);
}
const receiveTeamIntroduce = (val) =>{
  profile.text = val.value;
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
