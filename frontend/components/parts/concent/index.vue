<template>
  <v-container>
    <div class="d-flex flex-wrap align-center justify-center">
      <PartsFormInputsCheckBox
      class="mr-4"
      @check="check"
      :value="value"
      />
      <PartsRulesTerms />
      <span>・</span>
      <PartsRulesPrivacyPolicy />
        を確認し、同意しました<span class="text-red text-caption">※</span>
    </div>
  </v-container>
</template>

<script setup lang="ts">
import { useField } from "vee-validate";
import { ref } from "vue";

const { handleChange } = useField("checkbox");

const props = defineProps({
  value:{
    type:Boolean,
    default:false
  }
})

const emits = defineEmits(["check"]);

const checked = ref(false);

const check = () => {
  checked.value = checked.value ? false : true;
  emits("check", checked.value);
};
</script>

<style lang="scss" scoped>
input[type="checkbox"] {
  appearance: none;
  position: relative;

  &::before {
    content: "";
    display: block;
    width: 20px;
    height: 20px;
    border: 2px solid #0104b7;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    opacity: 0.6;
    -webkit-transition: all 0.12s, border-color 0.08s;
    transition: all 0.12s, border-color 0.08s;
  }

  &:checked {
    &::before {
      width: 10px;
      top: -5px;
      left: 5px;
      border-radius: 0;
      opacity: 1;
      border-top-color: transparent;
      border-left-color: transparent;
      transform:translate(-80%,-40%) rotate(45deg);
    }
  }
}
</style>
