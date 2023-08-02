<template>
  <div>
    <label class="block text-gray-700 text-sm font-bold mb-1"> パスワード(確認)<span class="text-red text-caption">※</span>

    </label>
    <Field
      name="password"
      type="password"
      aria-placeholder="パスワードを入力"
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
      @input="submit"
      v-model="pass"
    />
    <span class="text-caption">※８文字以上、半角英数・記号</span>
    <ErrorMessage class="text-red" name="password" />
  </div>
</template>
<script setup lang="ts">
import {  Field, ErrorMessage } from 'vee-validate'
import {ref} from 'vue';


const props = defineProps({
  pass:String,
})
const pass = ref(props.pass);

const emits = defineEmits(['setPass']);

const submit=()=> {
  emits('setPass',pass.value);

}
</script>
