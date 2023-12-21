<template>
  <div class="bg-white my-2">
    <v-tabs
      v-model="tab"
      fixed-tabs
      class="text-center mb-4"
      slider-color="red"
    >
      <v-tab
        class="w-50"
        v-for="(val, index) in tabs"
        :key="index"
        :value="val.value"
      >
        {{ val.name }}
      </v-tab>
    </v-tabs>
    {{ tab }}
  </div>
</template>

<script setup lang="ts">
import { useTeamStore } from '~/stores/useTeamStore';

const teamStore = useTeamStore();
const tab = ref('latest');

const tabs = [
  {
    name: "新着順",
    value: "latest",
  },
  {
    name: "メンバー数順",
    value: "member",
  },
  // {
  //   name:'人気順',
  //   value:'popular'
  // },
];

watch(
  ()=>tab.value,
  ()=>{
    teamStore.deleteTeamValue();
    teamStore.setTab(tab.value);
    teamStore.fetchTeams();

  }
)


</script>
