<template>
  <v-card @click="onClick" height="300px">
    <div class="relative z-0 h-[100px]">
      <AtomsImgsCardHeaderImg
        :disabled="false"
        :path="config.public.baseURL + '/storage/' + header_img_path"
      >
        <AtomsImgsThumbnail
          :disabled="false"
          :path="config.public.baseURL + '/storage/' + thumbnail_path"
        />
      </AtomsImgsCardHeaderImg>
    </div>
    <v-card-title class="w-60 text-body-2 text-left ml-auto">
      <AtomsDecorationHeadline>
        {{ title }}
      </AtomsDecorationHeadline>
    </v-card-title>
    <v-card-text>
      {{ text }}
    </v-card-text>
  </v-card>
</template>

<script setup lang="ts">
import { useRuntimeConfig } from "nuxt/app";
import { navigateTo } from "nuxt/app";

const props = defineProps({
  header_img_path: String,
  thumbnail_path: String,
  title: String,
  text: String,
});

const config = useRuntimeConfig();

const onClick = () => {
  return navigateTo("/recruit/recruitdetail");
};
</script>

<style lang="scss" scoped>
.v-card {
  position: relative;
  & + & {
    margin-top: 1rem;
  }
}
.v-avatar {
  position: absolute !important;
  bottom: -40px;
  left: 20px;
  z-index: 10;
}

.v-responsive {
  position: unset !important;
}
</style>
