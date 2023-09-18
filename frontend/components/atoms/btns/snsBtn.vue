<template>
  <v-btn
    variant="outlined"
    rounded="0"
    @click="onClick"
  >
    <slot/>
  </v-btn>
</template>


<script setup lang="ts">
import { useAuthStore } from '../../../stores/useAuthStore';
import {useRuntimeConfig} from 'nuxt/app';

const auth = useAuthStore();
const config = useRuntimeConfig();
const props = defineProps({
  provider:{
    type:String,
    default:undefined
  }
})

const emits = defineEmits(['click']);

const onClick = () => {
  emits('click');
}



</script>
