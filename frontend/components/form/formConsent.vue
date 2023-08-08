<template>
  <v-container>
    <v-checkbox @input="submit" v-model="checkbox" color="black">
      <template v-slot:label>
        <div class="text-center">
          <v-tooltip location="bottom">
            <template v-slot:activator="{ props }">
              <NuxtLink class="text-red" :to="Url.TOP" v-bind="props"
                >利用規約</NuxtLink
              >
            </template>
            <span> 利用規約が表示されます </span>
          </v-tooltip>
          <v-tooltip v-bind="props"> </v-tooltip>
          <span>・</span>
          <v-tooltip location="bottom">
            <template v-slot:activator="{ props }">
              <NuxtLink class="text-red" :to="Url.TOP" v-bind="props"
                >プライバシーポリシー</NuxtLink
              >
            </template>
            プライバシーポリシーが表示されます
          </v-tooltip>
          を確認し、同意しました<span class="text-red text-caption">※</span>
        </div>
      </template>
    </v-checkbox>
  </v-container>
</template>

<script setup lang="ts">
import { Url } from "@/constants/url";
import { useField } from "vee-validate";
import {ref} from 'vue';

const {handleChange} = useField('checkbox');
const emits = defineEmits(["setCheck"]);

const checkbox = ref(false);


const submit = () => {
  emits('setCheck',checkbox.value);
}

</script>
