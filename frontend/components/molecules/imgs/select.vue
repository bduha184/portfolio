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
},
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
</style>
