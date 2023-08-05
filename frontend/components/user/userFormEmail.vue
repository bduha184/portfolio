<template>
  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2">
      メールアドレス<span class="text-red text-caption">※</span>
    </label>
    <input
      type="email"
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
      @input="submit"
      v-model="email"
    />
    <ErrorMessage class="text-red" name="email" />
  </div>
</template>
<script setup lang="ts">
// import {  Field, ErrorMessage } from 'vee-validate'
import {ref} from 'vue';

const props = defineProps({
  email:String
})



const email = ref('');

const emits=defineEmits(['setEmail']);

const submit = ()=> {
  emits('setEmail',email.value);
}



</script>
