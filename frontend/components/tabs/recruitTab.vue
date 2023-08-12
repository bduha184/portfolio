<template>
   <div class="bg-white my-5">
      <v-tabs
        v-model="tab"
        fixed-tabs
        class="text-center mb-4"
        slider-color="red"
      >
        <v-tab
        v-for="(tab,index) in tabs"
        :key="index"
        :value="tab.value"
        >
      {{ tab.name }}
        </v-tab>
      </v-tabs>
    </div>
</template>

<script setup lang="ts">
import {ref} from 'vue';

const tab = ref();

const tabs = [
  {
    name:'新着順',
    value:'latest'
  },
  {
    name:'メンバー数順',
    value:'desc'
  },
  {
    name:'人気順',
    value:'popular'
  },
]



</script>
