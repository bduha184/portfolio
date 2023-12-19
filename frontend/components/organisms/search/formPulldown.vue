<template>
  <v-select
    variant="outlined"
    density="compact"
    v-model="item"
    :label="label"
    :items="props.items"
  />
</template>

<script setup lang="ts">
import type { Props } from "~/types/props";
import type { Emits } from "~/types/emits";

const props = defineProps<Props>();
const emits = defineEmits<Emits>();

const item = ref<string>("");

watch(
  () => item.value,
  () => {
    emits("emitInput", item.value);
  }
);
</script>

<style lang="scss" scoped>
.v-input {
  position: relative;
  z-index: 0;
  &:deep(.v-input__details) {
    display: none !important;
  }
  &:deep(.v-field--appended) {
    padding: 0 !important;
  }

  &:first-of-type {
    border-right: 0 !important;
  }

  &:deep(.v-field__outline) {
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    border-top-right-radius: 0 !important;
    border-bottom-right-radius: 0 !important;
  }

  &:not(:first-of-type) {
    &:deep(.v-field__outline) {
      border-radius: 0 !important;
    }
  }

  &:deep(.v-field__append-inner) {
    position: absolute;
    top: 50%;
    right: 0;
    transform: translateY(-50%);
    z-index: 1;
  }
}
</style>
