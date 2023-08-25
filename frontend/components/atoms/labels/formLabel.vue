<template>
  <label :for="label">
    <slot />
  </label>
</template>
<script setup>

const props  = defineProps({
  label:{
    type:String,
    default:''
  }
})
</script>
