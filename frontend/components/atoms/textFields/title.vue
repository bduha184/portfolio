<template>
  <v-text-field
    variant="outlined"
    :label="label"
    single-line
    hide-details
    density="compact"
    class="pl-2 leading-snug relative before:absolute before:left-0 before:top-0 before:h-full before:w-[3px] before:bg-orange-600 z-100"
  />
</template>

<script setup>

const props = defineProps({
  label:{
    type:String,
    default:''
  }
})

const emits = defineEmits([''])

</script>
