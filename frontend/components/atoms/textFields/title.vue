<template>
  <v-text-field
    variant="outlined"
    :label="label"
    single-line
    hide-details
    density="compact"
    @input="onChange"
    :value="title"
  />
</template>

<script setup>

const props = defineProps({
  label:{
    type:String,
    default:''
  },
  title:{
    type:String,
    default:''
  }
})

const emits = defineEmits(['emitInput'])

const onChange = (e)=>{
  emits('emitInput',e.target);
}

</script>
