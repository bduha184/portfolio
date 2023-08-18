<template>
  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2">
      メールアドレス<span class="text-red text-caption">※</span>
    </label>
    <input
      type="email"
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
      @input="submit"
      @blur="handleChange"
      :value="name"
    />
    <p class="text-red">{{ errors.email }}</p>
  </div>
</template>
<script setup lang="ts">
import { useForm ,useField } from "vee-validate";
import {object,string} from "yup";

const props = defineProps({
  name:String
});


const emailSchema = object({
  email:
  string().
  trim().
  lowercase().
  required('メールアドレスは必須項目です').
  email("正しいメールアドレスを入力してください。")
});
const { errors, useFieldModel } = useForm({
  validationSchema: emailSchema,
  initialValues: {
    email: '',
  },

});


const email = useFieldModel('email');
const {handleChange} = useField('email');
const emits = defineEmits(["setEmail"]);

const submit = () => {
  emits("setEmail",email);
};
</script>
