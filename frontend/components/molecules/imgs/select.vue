<template>
  <AtomsImgs :src="props.path" @emitClick="openFileSelect">
    <AtomsInput
      type="file"
      class="d-none"
      accept="image/*"
      :isSelecting="props.isSelecting"
      :disabled="props.disabled"
      @emitInput="receiveImg"
    />
  </AtomsImgs>
</template>

<script setup lang="ts">
import type { Props } from "~/types/props";
import type { Emits } from "~/types/emits";
const props = withDefaults(defineProps<Props>(), {
  disabled: false,
});
const emits = defineEmits<Emits>();

const isSelecting = ref<boolean>(false);

const openFileSelect = () => {
  isSelecting.value = true;
  window.addEventListener(
    "focus",
    () => {
      isSelecting.value = false;
    },
    { once: true }
  );
};
const receiveImg = (val: File) => {
  emits("emitInput", val);
};
</script>

<style lang="scss" scoped>
.v-avatar {
  position: absolute !important;
  bottom: -40px;
  left: 20px;
  z-index: 10;
}
</style>
