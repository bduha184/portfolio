<template>
  <div>
    <AtomsLabelsFormLabel class="block text-gray-700 text-sm font-bold pb-1">
      {{ props.label }}<span class="text-red text-caption">※</span>
    </AtomsLabelsFormLabel>
    <AtomsInput
      :type="props.type"
      :val="props.val"
      @emitInput="receiveInput"
      @blur="handleChange"
      @change="onChange"
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
import type { Props } from "~/types/props";
import type { Emits } from "~/types/emits";
import { formSchema } from "~/constants/formSchema";
import { useForm, useField } from "vee-validate";

const props = withDefaults(defineProps<Props>(), {
  confirm: true,
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

const receiveInput = (value: string) => {
  val.value = value.value;
};
const emit = defineEmits<Emits>();

const onChange = () => {
  emit("emitInput", { val, errors, confirm });
};
</script>
