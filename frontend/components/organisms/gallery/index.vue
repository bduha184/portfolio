<template>
   <div>
    <!-- サムネイル -->
    <div class="thumbnail-list">
      <v-img :src="path"
         class="thumbnail-list__img"
         v-for="(path, index) of thumb_image_paths"
         @click="activeImgIndex = index"
      />
  </div>
  <!-- /サムネイル -->

  <!-- 画像モーダル -->
  <LightGallery
    :images="image_paths"
    :index="activeFileIndex"
    :disable-scroll="true"
    @close="activeImgIndex = null"
  />
  <!-- /画像モーダル -->
</template>

<script setup>
</script>
