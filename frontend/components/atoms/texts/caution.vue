<template>
  <p
  :class="classes"
  >
    <slot/>
  </p>
</template>

<script setup lang="ts">
const props=defineProps({
  classes:{
    type:String,
    default:''
  },
})

</script>
