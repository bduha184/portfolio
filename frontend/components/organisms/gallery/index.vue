<template>

  <v-container>
    <AtomsDecorationHeadline>
      ギャラリー
    </AtomsDecorationHeadline>
    <VueGallery :images="data.images" :index="data.index" @close="data.index = null"></VueGallery>
    <v-row>
      <v-col
      cols="4"
      class="image"
          v-for="(image, imageIndex) in data.images"
          :key="imageIndex"
          @click="data.index = imageIndex"

      >
      <v-img
      :src="image"
      />
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
  import VueGallery from 'vue-gallery';
import {ref} from 'vue';
const data= ref({
  images:[
'https://picsum.photos/500/300?image=1',
'https://picsum.photos/500/300?image=2',
'https://picsum.photos/500/300?image=2',
'https://picsum.photos/500/300?image=2',
'https://picsum.photos/500/300?image=2',
'https://picsum.photos/500/300?image=2',
'https://picsum.photos/500/300?image=2',
'https://picsum.photos/500/300?image=2',
'https://picsum.photos/500/300?image=2',
'https://picsum.photos/500/300?image=2',
'https://picsum.photos/500/300?image=2',
'https://picsum.photos/500/300?image=2',
'https://picsum.photos/500/300?image=2',
],
index:null
})

</script>

<style scoped>
.v-row {
  max-height: 200px;
  overflow: scroll !important;
}

.v-container p {
  margin-bottom: 1rem;
}

  .image {
    padding:0.2rem !important;
  }
</style>
