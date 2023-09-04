<template>
  <div>
    <TitleHeadline title="チーム代表者"/>
    <v-row>
      <ImgsAvatar
      :thumbnail_path="thumbnail_path"
      />
      <p>テストテスト</p>
    </v-row>
  </div>
</template>

<script setup lang="ts">
import { useRuntimeConfig } from 'nuxt/app';

const config = useRuntimeConfig();

const props = defineProps({
  header_img_path:String,
  thumbnail_path:String,
})

</script>


<style lang="scss" scoped>

</style>
