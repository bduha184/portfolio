<script setup lang="ts">
import {ref} from 'vue';

const tab = ref(null);

const tabs = [
  {
    name:'新着順',
    value:'latest'
  },
  {
    name:'メンバー数順',
    value:'member'
  },
  // {
  //   name:'人気順',
  //   value:'popular'
  // },
]

interface Emits {
  (e:"emitSelectedTab",value:String):void;
}

const emits = defineEmits<Emits>();

const onClick = ()=> {
  emits('emitSelectedTab',tab.value);
}

</script>
<template>
  <div class="bg-white my-2">
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
       @click="onClick"
       >
     {{ tab.name }}
       </v-tab>
     </v-tabs>
   </div>
</template>
