<template>
  <v-container>
    <div class="d-flex flex-wrap align-center">
      <input
        type="checkbox"
        class="mr-4"
        :class="{ active: checked }"
        v-model="checked"
        @click="submit"
      />
      <RulesPrivacyPolicy />
      <span>・</span>
      <RulesTerms />
      <a href="#" @click.prevent="submit">
        を確認し、同意しました<span class="text-red text-caption">※</span>
      </a>
    </div>
  </v-container>
</template>

<script setup lang="ts">
import { useField } from "vee-validate";
import { ref } from "vue";

const { handleChange } = useField("checkbox");
const emits = defineEmits(["setCheck"]);

const checked = ref(false);

const submit = () => {
  checked.value = checked.value ? false : true;
  emits("setCheck", checked.value);
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
