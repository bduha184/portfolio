<template>
  <v-icon
    :icon="props.name"
    :size="props.size"
    :class="props.padding"
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
