<template>
    <v-icon
      :icon="name"
      :size="size"
    />
</template>

<script setup lang="ts">
defineProps({
  size:{
    type:Number,
    default:35
  },
  name: String,
});
</script>
