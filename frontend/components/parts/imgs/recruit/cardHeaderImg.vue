<template>
  <v-img :src="recruit.getRecruitHeaderUrl" cover>
    <slot/>
    <v-file-input variant="solo" name="header_img" @change="onChange" />
  </v-img>
</template>

<script setup lang="ts">
import { useRuntimeConfig } from "nuxt/app";
import { useRecruitStore } from "../../../../stores/useRecruitStore";

const config = useRuntimeConfig();
const recruit = useRecruitStore();

const props = defineProps({
  header_img_path: String,
  thumbnail_path: String,
});
</script>

<style lang="scss" scoped>

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
