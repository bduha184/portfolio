<template>

  <v-container>
    <AtomsDecorationHeadline>
      ギャラリー
    </AtomsDecorationHeadline>
    <VueGallery :images="props.images" :index="index" @close="index = null"></VueGallery>
    <v-row>
      <v-col
      cols="4"
      class="image"
          v-for="(image, imageIndex) in props.images"
          :key="imageIndex"
          @click="index = imageIndex"

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

const props =  defineProps({
  images:{
    type:Array,
    default:[]
  }
})
const index = ref(null);

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
