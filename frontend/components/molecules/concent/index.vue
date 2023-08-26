<template>
  <v-container>
    <div class="d-flex flex-wrap align-center justify-center">
      <AtomsInput
      type="checkbox"
      class="pr-2"
      @emitInput="check"
      :val="val"
      />
      <MoleculesRulesTerms />
      <span>・</span>
      <MoleculesRulesPrivacyPolicy />
        を確認し、同意しました<span class="text-red text-caption">※</span>
    </div>
  </v-container>
</template>

<script setup lang="ts">
import { ref } from "vue";

const props = defineProps({
  val:Boolean,

})

const emits = defineEmits(["emitInput"]);
const checked = ref(false);

const check = (val) => {
  checked.value = JSON.parse(val.value) ? false : true;
  emits("emitInput", checked.value);
};
</script>
