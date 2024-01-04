<template>
  <v-icon :icon="props.name" :size="props.size" />
</template>

<script setup lang="ts">
import type { Props } from "~/types/props";

const props = withDefaults(defineProps<Props>(), {
  size: 35,
});
</script>
