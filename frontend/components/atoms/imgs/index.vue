<template>
  <v-img :src="path" @click="onClick" cover>
    <slot />
  </v-img>
</template>

<script setup lang="ts">
import type { Emits, Props } from "~/types";

const props = defineProps<Props>();

const emits = defineEmits<Emits>();

const onClick = (e: Event) => {
  emits("emitClick", e.target as HTMLElement);
};
</script>
~/types/types ~/types/types
