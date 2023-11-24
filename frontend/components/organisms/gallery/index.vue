<script setup lang="ts">
import { Icons } from "~/constants/icons";
import { useGalleryStore } from "~/stores/useGalleryStore";

const gallery = useGalleryStore();

const router = useRoute();

const props = defineProps({
  images: {
    type: Array,
    default: [],
  },
});

const deleteImage = (target) => {
  gallery.deleteImages(target);

};


</script>

<template>
  <v-container>
    <v-row>
      <v-col
        cols="4"
        class="image"
        v-for="(image, index) in images"
        :key="index"
      >
      <v-img :src="image"
      @click="gallery.selectImage(index)"
      >
        <v-btn
        density="compact"
        variant="text"
        :icon="Icons.CLOSE"
        @click="deleteImage(index)"
        v-if="router.path.indexOf('auth') != -1"
        />
      </v-img>
      </v-col>
    </v-row>
  </v-container>
</template>

<style scoped lang="scss">
.v-row {
  max-height: 300px;
  overflow: scroll !important;
}

.v-container p {
  margin-bottom: 1rem;
}

.v-img{
  &:deep(.v-responsive__sizer){
    padding-bottom: 100% !important;
  }
&:deep(.v-img__img--contain){
  object-fit: cover;
}
}
.image {
  padding: 0.2rem !important;
}
</style>
