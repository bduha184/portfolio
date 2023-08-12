<template>
  <v-card-text>
    {{ text }}
  </v-card-text>
</template>

<script setup lang="ts">
import {ref} from 'vue';
const props = defineProps({
  text:String
})

const text = ref('test');

</script>
