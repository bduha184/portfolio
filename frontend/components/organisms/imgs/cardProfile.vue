<template>
  <div class="relative z-0 h-[100px]">
    <MoleculesImgsSelect
    @emitInput="receiveHeaderImg"
    :path="pathHeader"
    :disabled="disabled"
    size="cover"
    />
    <v-avatar size="80" color="white">
      <MoleculesImgsSelect
      @emitInput="receiveThumbnail"
      :path="pathThumbnail"
      :disabled="disabled"
      />
    </v-avatar>
  </div>
</template>

<script setup lang="ts">
import type {Emits,Props} from "~/types";

const props = defineProps<Props>();

const emits = defineEmits<Emits>();
const receiveHeaderImg = (val:File,target:string) => {
  emits('emitInput',{val,target:'header'});
};
const receiveThumbnail = (val:File,target:string) => {
  emits('emitInput',{val,target:'thumbnail'});
};

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
  position: absolute !important;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
  height: 100%;
  z-index: 10;
  background: red;
}
</style>
