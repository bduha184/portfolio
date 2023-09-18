<template>
    <v-img
    :src="path"
    cover
    @click="onClick"
    >
    <slot/>
    </v-img>
</template>

<script setup lang="ts">
const props= defineProps({
  path: {
    type:String,
    default:''
  },
})


interface Emits {
  (e: "emitClick"): void;
}
const emits = defineEmits<Emits>();

const onClick = ()=> {
  emits('emitClick');
}


</script>
