<template>
  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-1">
      ユーザーネーム<span class="text-red text-caption">※</span>
    </label>
    <input
      name="name"
      type="text"
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
      @input="submit"
      @blur="handleChange"
      :value="val"
    />
    {{ errors }}
    <p v-if="errors.name" class="text-red">{{errors.name}}</p>
    <p v-else class="text-caption">※20文字以内</p>
  </div>
</template>
<script setup lang="ts">
import { useForm ,useField } from "vee-validate";
import {object,string} from "yup";

const props = defineProps({
  val: String,
});
const emailSchema = object({
  name:
  string().
  trim().
  required('必須項目です').
  min(3,'3文字以上で入力してください').
  max(20,'20文字以内で入力してください'),
});
const { errors } = useForm({
  validationSchema: emailSchema,
});

// const val = useFieldModel('name');
const {value:val,handleChange}=useField('name');
const emits=defineEmits(['emitInput']);

const submit = ()=> {
  emits('emitInput',val);
}


</script>
