<template v-slot:prepend>
  <v-icon
    :icon="name"
    class="relative before:absolute before:w-10 before:h-10 before:border-2 before:border-gray-400 before:rounded-full"
  />
</template>

<script setup lang="ts">
defineProps({
  name: String,
});
</script>
