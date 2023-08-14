<template>
  <div>
    <TitleHeadline title="ギャラリー"/>
    <no-ssr>
      <LightGallery
        :images="images"
        :index="index"
        :disable-scroll="true"
        @close="index = null"
      />
      <ul>
        <li
          v-for="(thumb, thumbIndex) in "
          :key="thumbIndex"
          @click="index = thumbIndex"
        >
          <img :src="thumb">
        </li>
      </ul>
    </no-ssr>
  </div>
</template>
<script setup lang="ts">
import {ref} from 'vue';
import {LightGallery} from 'vue-light-gallery';

const index = ref(null);

const props = defineProps({
  images:Object
})

</script>
