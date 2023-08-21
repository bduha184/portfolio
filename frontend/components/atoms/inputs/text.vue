<template>
  <input
    name="name"
    :type="type"
    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
    @input="submit"
    :value="val"
  />
</template>

<script setup lang="ts">
import {ref} from 'vue';
// import {inject} from 'vue';
// const type = inject('type');

const props = defineProps({
  type:{
    type:String,
    default:'text'
  },
  val:{
    type:String,
    default:''
  }
})

const value = ref(props.val);


const emits = defineEmits();

const submit = () => {
  emits('input',value);
}

</script>
