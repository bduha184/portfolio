<template>
  <div>
    <TitleHeadline title="チーム活動詳細"/>

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
