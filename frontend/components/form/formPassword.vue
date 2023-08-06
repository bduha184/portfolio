<template>
  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-1"> パスワード <span class="text-red text-caption">※</span></label>
    <input
      type="password"
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
      @input="submit"
      v-model="password"
    />
    <p>{{ errors.password }}</p>
    <span class="text-caption">※８文字以上、半角英数・記号</span>
  </div>
</template>
<script setup lang="ts">
import { useForm ,useField } from "vee-validate";
import {object,string} from "yup";

const props = defineProps({
  password: String,
});
const emailSchema = object({
  password: string().
  required('必須項目です').
  max(20,'20文字以内で入力してください'),
});
const { errors, useFieldModel } = useForm({
  validationSchema: emailSchema,
  initialValues: {
    password: '',
  },
});

const password = useFieldModel('password');
const emits= defineEmits(['setPassword']);

const submit = ()=> {
  emits('setPassword',password)
}

</script>
