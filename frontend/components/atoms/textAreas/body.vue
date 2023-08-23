<template>
  <v-textarea
  single-line
  hide-details
  variant="outlined"
  :label="label"
  />
</template>
<script setup>

const props = defineProps({
  label:{
    type:String,
    default:''
  }
})

</script>
