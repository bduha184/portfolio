<template>
  <p :class="classes">
    <slot />
  </p>
</template>

<script setup lang="ts">
import type { Props } from "~/types/props";
defineProps<Props>();
</script>
