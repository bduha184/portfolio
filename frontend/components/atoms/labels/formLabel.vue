<template>
  <label :for="label">
    <slot />
  </label>
</template>

<script setup lang="ts">
import type { Props } from "~/types/props";
defineProps<Props>();
</script>
