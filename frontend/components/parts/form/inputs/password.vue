<template>
  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-1"> パスワード <span class="text-red text-caption">※</span></label>
    <input
      type="password"
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
      @input="submit"
      :value="name"
    />
    <p v-if="errors.password" class="text-red">{{ errors.password }}</p>
    <p v-else class="text-caption">※８文字以上、半角英数・記号</p>
  </div>
</template>
<script setup lang="ts">
import { useForm ,useField } from "vee-validate";
import {object,string} from "yup";

const props = defineProps({
  name: String,
});
const emailSchema = object({
  password:
  string().
  trim().
  required('必須項目です').
  min(8,'8文字以上で入力してください').
  matches(/^[ -~]+$/, "半角英数記号で入力してください。"),
});
const { errors, useFieldModel } = useForm({
  validationSchema: emailSchema,
  initialValues: {
    password: '',
  },
});

const password = useFieldModel('password');
const {handleChange} = useField('password');
const emits= defineEmits(['setPassword']);

const submit = ()=> {
  emits('setPassword',password)
}

</script>
