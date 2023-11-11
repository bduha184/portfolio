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

interface Emits {
(e:"emitClick"):void
}

const emits = defineEmits<Emits>();

const onClick = () => {
  emits('emitClick');
}


</script>
