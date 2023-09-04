<template>
  <div>
    <VueGallery :images="data.images" :index="data.index" @close="data.index = null"></VueGallery>
    <div
      class="image"
      v-for="(image, imageIndex) in data.images"
      :key="imageIndex"
      @click="data.index = imageIndex"
      :style="{ backgroundImage: 'url(' + image + ')', width: '300px', height: '200px' }"
    ></div>
  </div>
</template>

<script setup>
  import VueGallery from 'vue-gallery';
import {ref} from 'vue';
const data= ref({
  images:[
'https://picsum.photos/500/300?image=1',
'https://picsum.photos/500/300?image=2',
],
index:null
})

</script>

<style scoped>
  .image {
    float: left;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    border: 1px solid #ebebeb;
    margin: 5px;
  }
</style>
