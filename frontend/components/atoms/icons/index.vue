<template>
    <v-icon
      :icon="name"
      :size="size"
      :class="padding"
      class="border-solid border-2 border-gray-300 rounded-full"
    />
</template>

<script setup lang="ts">
defineProps({
  size:{
    type:Number,
    default:35
  },
  padding:{
    type:String,
    default:'p-1'
  },
  name: String,
});
</script>
