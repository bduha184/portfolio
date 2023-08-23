<template>
  <v-container>
    <div class="d-flex flex-wrap align-center justify-center">
      <AtomsInput
      type="checkbox"
      class="pr-2"
      @emitInput="check"
      :val="value"
      />
      <MoleculesRulesTerms />
      <span>・</span>
      <MoleculesPrivacyPolicy />
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

const emits = defineEmits(["emitInput"]);

const checked = ref(false);

const check = () => {
  checked.value = checked.value ? false : true;
  emits("emitInput", checked.value);
};
</script>
