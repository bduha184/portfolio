<template>
  <div>
    <div class="d-flex flex-wrap align-center justify-center">
      <AtomsInput
        type="checkbox"
        class="pr-2"
        @emitInput="receiveInput"
        :val="val"
      />
      <MoleculesRulesTerms />
      <span>・</span>
      <MoleculesRulesPrivacyPolicy />
      を確認し、同意しました<span class="text-red text-caption">※</span>
    </div>
  </div>
</template>

<script setup lang="ts">
import type { Emits, Props } from "~/types";

const props = defineProps<Props>();

const emits = defineEmits<Emits>();
const checked = ref<boolean>(false);

const receiveInput = (val: Event) => {
  checked.value = JSON.parse(val.value) ? false : true;
  emits("emitInput", checked.value);
};
</script>

<style scoped lang="scss">
input[type="checkbox"] {
  width: auto !important;
  margin-right: 0.5rem;
}
</style>
~/types/types ~/types/types
