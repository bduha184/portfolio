<template>
  <div>
    <AtomsDecorationHeadline>
      募集チーム：
    </AtomsDecorationHeadline>
    <span class="text-red pr-1">{{ val }}</span>件
  </div>
</template>

<script setup lang="ts">

const props = defineProps({
  val:{
    type:Number,
    default:0
  }
})

</script>
