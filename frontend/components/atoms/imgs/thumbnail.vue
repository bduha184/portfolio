<template>
  <v-avatar size="80">
    <v-img :src="path" cover />
    <v-file-input variant="solo" @change="onChange" />
  </v-avatar>
</template>

<script setup lang="ts">
const props = defineProps({
  path: String,
});
const emits = defineEmits(['emitInput']);

const onChange = (e) => {
  emits('emitInput',e.target);
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
