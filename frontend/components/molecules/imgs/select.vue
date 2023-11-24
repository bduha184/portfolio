<script setup lang="ts">
import type { Emits,Props} from "~/types";
const props = withDefaults(defineProps<Props>(),{
  disabled:false,
});
const emits = defineEmits<Emits>();

const isSelecting = ref<boolean>(false);

const openFileSelect= () => {
isSelecting.value = true
window.addEventListener('focus', () => {
  isSelecting.value = false
}, { once: true })
}
const receiveImg = (val:File)=> {
emits('emitInput',val)
}


</script>

<template>
  <AtomsImgs
  :src="path"
  @emitClick="openFileSelect"
  >
  <AtomsInput
   type="file"
   class="d-none"
   accept="image/*"
   :isSelecting="isSelecting"
   :disabled="disabled"
   @emitInput="receiveImg"
   />
</AtomsImgs>
</template>

<style lang="scss" scoped>
.v-avatar {
position: absolute !important;
bottom: -40px;
left: 20px;
z-index: 10;
}
</style>
