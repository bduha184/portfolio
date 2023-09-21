<template>
    <v-img
    :src="path"
    @click="onClick"
    cover
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
