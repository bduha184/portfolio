<template v-slot="pretend">
<div>
  <v-icon
           :icon="name"
             class="relative before:absolute before:w-10 before:h-10 before:border-2 before:border-gray-400 before:rounded-full"
           />
</div>
</template>

<script setup lang="ts">

defineProps({
  name:String
})

</script>
