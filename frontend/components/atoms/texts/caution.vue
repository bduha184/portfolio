<template>
  <p :class="props.classes">
    <slot />
  </p>
</template>

<script setup lang="ts">
import type { Props } from "~/types/props";
const props = defineProps<Props>();
</script>
