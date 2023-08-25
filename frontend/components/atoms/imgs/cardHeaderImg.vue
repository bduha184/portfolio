<template>
  <v-img :src="path" cover>
    <slot/>
    <v-file-input variant="solo" @change="onChange" />
  </v-img>
</template>

<script setup lang="ts">
const props = defineProps({
  path: String,
});

console.log(props.path);

const emits  =  defineEmits(['emitInput'])

const onChange = (e) => {
  emits('emitInput',e.target);
}
</script>

<style lang="scss" scoped>

.v-responsive {
  position: unset !important;
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
