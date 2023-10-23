<template>
  <v-container>
    <v-row>
      <v-col
        cols="4"
        class="image"
        v-for="(image, imageIndex) in images"
        :key="imageIndex"
      >
        <v-img :src="image" >
          <v-btn
          density="compact"
          variant="text"
          :icon="Icons.CLOSE"
          @click="deleteImage();index = imageIndex;"
          />
        </v-img>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import VueGallery from "vue-gallery";
import { ref, computed } from "vue";
import { Icons } from "../../../constants/icons";

const props = defineProps({
  images: {
    type: Array,
    default: [],
  },
});

const index = ref();

const emits = defineEmits(["emitClick"]);

const deleteImage = () => {
  emits("emitClick", index.value);
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
