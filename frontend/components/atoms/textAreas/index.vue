<template>
  <textarea
  class="shadow appearance-none border min-h-[150px] rounded w-full p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
  :label="label"
  @blur="submit"
  :placeholder="placeholder"
  :value="body"
  >
  </textarea>
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
  },
  placeholder:{
    type:String,
    default:''
  },
})

const emits = defineEmits(['emitInput']);

const submit = (e)=> {
  emits('emitInput',e.target);
}

</script>
