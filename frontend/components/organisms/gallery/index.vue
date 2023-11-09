<template>
  <v-container>
    <v-row>
      <v-col
        cols="4"
        class="image"
        v-for="(image, index) in images"
        :key="index"
      >
        <v-img :src="image" >
          <v-btn
          density="compact"
          variant="text"
          :icon="Icons.CLOSE"
          @click="deleteImage(index)"
          />
        </v-img>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { Icons } from "~/constants/icons";
import { useGalleryStore } from "~/stores/useGalleryStore";
const gallery = useGalleryStore();

const props = defineProps({
  images: {
    type: Array,
    default: [],
  },
});

// const displayImages = computed(()=>{
//   Array.from(props.images).forEach(image => {
//         // this.postImages.push(image);
//         // let imageUrl = URL.createObjectURL(image);
//         // this.displayImages.push(imageUrl);
//       })
// })


const deleteImage = (target) => {
  gallery.deleteImages(target);

};


</script>

<style scoped>
.v-row {
  max-height: 300px;
  overflow: scroll !important;
}

.v-container p {
  margin-bottom: 1rem;
}

.image {
  padding: 0.2rem !important;
}
</style>
