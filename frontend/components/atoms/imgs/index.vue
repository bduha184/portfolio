<template>
  <v-img :src="path" @click="onClick" cover>
    <slot />
  </v-img>
</template>

<script setup lang="ts">
import type { Props } from "~/types/props";
import type { Emits } from "~/types/emits";

const props = defineProps<Props>();

const emits = defineEmits<Emits>();

const onClick = (e: Event) => {
  emits("emitClick", e.target as HTMLElement);
};
</script>
