<template>
  <div class="mb-4">
    <AtomsLabelsFormLabel class="block text-gray-700 text-sm font-bold mb-1">
      {{ label }}<span class="text-red text-caption">※</span>
    </AtomsLabelsFormLabel>
    <AtomsInputsText :type="type" :val="val" @input="receive"/>
    <p v-if="errors.name" class="text-red">{{errors.name}}</p>
    <p v-else class="text-caption">※20文字以内</p>
  </div>
</template>
<script setup lang="ts">
import { useForm ,useField } from "vee-validate";
import {object,string} from "yup";
import {ref} from 'vue';
import  {formSchema}  from "../../../constants/formSchema.ts"

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


const emitValue = ref();

const receive = (val) => {
  emitValue.value = val;
}

const emailSchema = formSchema.EMAIL;
const { errors, useFieldModel } = useForm({
  validationSchema: emailSchema,
  initialValues: {
    name: '',
  },
});

const name = useFieldModel('name');
const {handleChange}=useField('name');
const emits=defineEmits();

const submit = ()=> {
  emits('setName',emitValue);
}


</script>
