<template>
  <v-icon :icon="name" :size="size" />
</template>

<script setup lang="ts">
import type { Props } from "~/types";

const props = withDefaults(defineProps<Props>(), {
  size: 35,
});
</script>
~/types/types ~/types/types
