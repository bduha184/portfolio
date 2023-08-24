<template>
  <v-textarea
  single-line
  hide-details
  variant="outlined"
  :label="label"
  :value="body"
  @input="submit"
  />
</template>
<script setup>

const props = defineProps({
  label:{
    type:String,
    default:''
  },
  body:{
    type:String,
    default:''
  }
})

const emits = defineEmits(['emitInput']);

const submit = (e)=> {
  emits('emitInput',e.target);
}

</script>
