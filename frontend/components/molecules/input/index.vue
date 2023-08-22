<template>
  <div class="mb-4">
    <AtomsLabelsFormLabel class="block text-gray-700 text-sm font-bold mb-1">
      {{ label }}<span class="text-red text-caption">※</span>
    </AtomsLabelsFormLabel>
    <AtomsInput
    :type="type"
    :val="val"
    @emitInput="receive"
    @blur="handleChange"
    @input="submit"
    />
    <p v-if="errors.name" class="text-red">{{errors.name}}</p>
    <p v-else class="text-caption">
      <span v-show="type == 'text'">※20文字以内</span>
      <span v-show="type == 'password'">※８文字以上、半角英数・記号</span>
    </p>
  </div>
</template>
<script setup lang="ts">
import { useForm ,useField } from "vee-validate";
import {ref} from 'vue'
import {object,string} from "yup";

import  { formSchema }  from '../../../constants/formSchema';

const props = defineProps({
  label: {
    type:String,
    default:''
  },
  type:{
    type:String,
    default:''
  },
  val:{
    type:String,
    default:''
  }
});
// const emitValue = ref();

const schema = object({
    email:string().trim().lowercase().
    required('メールアドレスは必須項目です').
    email("正しいメールアドレスを入力してください。"),
    name:
    string().
    trim().
    required('必須項目です').
    min(3,'3文字以上で入力してください').
    max(20,'20文字以内で入力してください'),
    password:
    string().
    trim().
    required('必須項目です').
    min(8,'8文字以上で入力してください').
    matches(/^[ -~]+$/, "半角英数記号で入力してください。"),
})

const { errors, useFieldModel,handleSubmit } = useForm({
  validationSchema: schema,
  initialValues: {
    name:'',
    email: '',
    password:''
  },
});


const val = useFieldModel('name');
const {handleChange}=useField('name');
// const receive = (val) => {
//   emitValue.value = val;
// }
const emit=defineEmits(['emitInput']);

const submit = handleSubmit((val)=> {
  console.log(val);
  emit('emitInput',val);
})


</script>
