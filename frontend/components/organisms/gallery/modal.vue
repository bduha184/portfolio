<template>
  <v-container>
    <VueGallery
      :images="images"
      :index="index"
      @close="index = null"
    ></VueGallery>
    <v-row>
      <v-col
        cols="4"
        class="image"
        v-for="(image, imageIndex) in images"
        :key="imageIndex"
        @click="index = imageIndex"
      >
        <v-img :src="image" @click="deleteImage" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import VueGallery from "vue-gallery";
import { ref, computed } from "vue";

const props = defineProps({
  images: {
    type: Array,
    default: [],
  },
});

const index = ref();

console.log(index.value);

const emits = defineEmits(["emitClick"]);

const deleteImage = () => {
  emits("emitClick", index.value);
};
</script>

<style scoped>
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

.blueimp-gallery {
  background: rgba(0, 0, 0, 0.85);
}
</style>
