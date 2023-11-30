
<template>
  <v-container class="absolute">
    <VueGallery
      :images="gallery.getImages"
      :index="gallery.getTargetImage"
      @close="index = null"
    ></VueGallery>
  </v-container>
</template>


<script setup lang="ts">
import VueGallery from "vue-gallery";
import { useGalleryStore } from "~/stores/useGalleryStore";

const props = defineProps({
  images: {
    type: Array,
    default: [],
  },
});

const images = ref([]);

const gallery = useGalleryStore();

console.log(gallery.getTargetImage)
</script>
<style scoped lang="scss">
.v-row {
  max-height: 300px;
  overflow-y: scroll !important;
}

.v-container p {
  margin-bottom: 1rem;
}

.image {
  padding: 0.2rem !important;
}

.v-img{
  &:deep(.v-responsive__sizer){
padding-bottom: 100% !important;
  }
  &:deep(.v-img__img--contain){
    object-fit: cover !important;
  }
}
.blueimp-gallery {
  background: rgba(0, 0, 0, 0.85);
}
</style>
