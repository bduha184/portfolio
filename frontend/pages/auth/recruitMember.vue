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
          :src="items.url_header_img" cover>
            <v-avatar size="80">
              <v-img :src="items.url_thumbnail" cover />
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
            v-model="items.title"
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
          v-model="items.text"
          />
        </v-card-text>
        <ButtonCommon
        btnValue="登録"
        width="16rem"
        class="my-4 d-block"
        type="submit"
        @click.prevent="handleRegister"
        :disabled="!checkFilledOut()"
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

const config = useRuntimeConfig();
definePageMeta({
  middleware: ["auth"],
});

const recruit = useRecruitStore();
const route = useRoute();

const items = ref({
  header_img: "",
  thumbnail: "",
  title: "",
  text: "",
  id:"",
  url_header_img: config.public.appURL+"/images/noimage.jpg",
  url_thumbnail: config.public.appURL+"/images/noimage.jpg",
});

console.log(recruit.getRecruitItem);

const onChange = (e) => {
  const target = e.target.name;
  if (target == "header_img") {
    items.value.header_img = e.target.files[0];
    items.value.url_header_img = URL.createObjectURL(items.value.header_img);
  } else {
    items.value.thumbnail = e.target.files[0];
    items.value.url_thumbnail = URL.createObjectURL(items.value.thumbnail);
  }
};


const handleRegister = async () => {
  const formData = new FormData();

  formData.append("header_img", items.value.header_img);
  formData.append("thumbnail", items.value.thumbnail);
  formData.append("title", items.value.title);
  formData.append("text", items.value.text);

  recruit.registerRecruitItem(formData);

  const recruitId = recruit.id;

  return navigateTo({
    path:Url.AUTHRECRUIT,
    query:{
      id:recruitId
    }
  })
};

const checkFilledOut = () => {

const fieldArray = [
  items.value.title,
  items.value.text,
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
