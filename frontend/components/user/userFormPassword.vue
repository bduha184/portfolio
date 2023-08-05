<template>
  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-1"> パスワード <span class="text-red text-caption">※</span></label>
    <input
      type="password"
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
      @input="submit"
      v-model="password"
    />
    <span class="text-caption">※８文字以上、半角英数・記号</span>
    <ErrorMessage class="text-red" name="password" />
  </div>
</template>
<script setup lang="ts">
// import {  Field, ErrorMessage } from 'vee-validate'
import {ref} from 'vue';

const props = defineProps({
  password:String,
})


const password=ref(props.password);
const emits= defineEmits(['setPassword']);

const submit = ()=> {
  emits('setPassword',password.value)
}

</script>
