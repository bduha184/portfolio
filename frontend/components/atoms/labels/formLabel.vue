<template>
  <label :for="props.label">
    <slot />
  </label>
</template>

<script setup lang="ts">
import type { Props } from "~/types/props";
const props = defineProps<Props>();
</script>
