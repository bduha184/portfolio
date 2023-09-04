<template>
  <div>
    <AtomsLabelsFormLabel class="block text-gray-700 text-sm font-bold pb-1">
      {{ label }}<span class="text-red text-caption">※</span>
    </AtomsLabelsFormLabel>
    <AtomsInput
      :type="type"
      :val="val"
      @emitInput="receive"
      @blur="handleChange"
      @change="submit"
    />
    <p v-if="errors.val" class="text-red">{{ errors.val }}</p>
    <p v-else class="text-caption">
      <span v-show="type == 'text'">※20文字以内</span>
      <span v-show="type == 'password'">※８文字以上、半角英数・記号</span>
    </p>
    <p v-show="!confirm" class="text-red">パスワードが異なります</p>
  </div>
</template>
<script setup lang="ts">
import { useForm, useField } from "vee-validate";
import { formSchema } from "../../../constants/formSchema";

const props = defineProps({
  label: {
    type: String,
    default: "",
  },
  type: {
    type: String,
    default: "",
  },
  val: {
    type: String,
    default: "",
  },
  confirm: {
    type: Boolean,
    default: true,
  },
});

let schema = {};
switch (props.type) {
  case "email":
    schema = formSchema.EMAIL;
    break;
  case "password":
    schema = formSchema.PASSWORD;
    break;
  default:
    schema = formSchema.NAME;
}

const { errors } = useForm({
  validationSchema: schema,
});

const { value: val, handleChange } = useField("val");

const receive = (receiveVal) => {
  val.value = receiveVal.value;
};
const emit = defineEmits(["emitInput"]);

const submit = () => {
  emit("emitInput", {val,errors,confirm});
};
</script>
