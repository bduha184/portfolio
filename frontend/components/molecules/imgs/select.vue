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

<script setup lang="ts">
import {ref} from '#imports';
const props = defineProps({
  path: {
    type:String,
    default:''
  },
  disabled:{
    type:Boolean,
    default:false
  }
});
interface Emits {
  (e: "emitInput", value: File): void;
}
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

<style lang="scss" scoped>
.v-avatar {
  position: absolute !important;
  bottom: -40px;
  left: 20px;
  z-index: 10;
}
.v-file-input {
  opacity: 0;
  position:absolute !important;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  width: 100%;
  height: 100%;
  z-index: 10;
  background: red;
}
</style>
