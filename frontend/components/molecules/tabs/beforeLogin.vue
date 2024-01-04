<template>
  <v-tab :value="props.val">
    <AtomsIcons class="d-block mx-auto" :name="props.icon" size="50" padding="p-2" />
    <slot />
  </v-tab>
</template>

<script setup lang="ts">
import type { Props } from "~/types/props";
const props = defineProps<Props>();
</script>

<style scoped lang="scss">
.v-btn {
  padding: 0.5rem !important;

  &:deep(.v-btn__content) {
    display: block;
  }
}
</style>
