<template>
  <p
  class="d-inline-block pl-2 leading-tight relative before:absolute before:left-0 before:top-0 before:h-full before:w-[3px] before:bg-orange-600 z-100"
  >
  {{ title }}
  </p>
</template>

<script setup lang="ts">

  const props = defineProps({
    title:String
  })

</script>
