<template>
  <v-icon
    :icon="name"
    :size="size"
    :class="padding"
    class="border-solid border-2 border-gray-300 rounded-full"
  />
</template>

<script setup lang="ts">
import type { Props } from "~/types/props";

const props = withDefaults(defineProps<Props>(), {
  size: 35,
  padding: "p-1",
});
</script>
