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
    <p>{{ errors.email }}</p>
  </div>
</template>
<script setup lang="ts">
import { useForm ,useField } from "vee-validate";
import {object,string} from "yup";

const props = defineProps({
  email: String,
});
const emailSchema = object({
  email: string().
  required('必須項目です').
  email('メールアドレスの形式ではありません。'),
});
const { errors, useFieldModel } = useForm({
  validationSchema: emailSchema,
  initialValues: {
    email: '',
  },
});

const email = useFieldModel('email');
const emits = defineEmits(["setEmail"]);

const submit = () => {
  emits("setEmail", email);
};
</script>
