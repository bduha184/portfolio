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
        v-for="(tab, index) in tabs"
        :key="index"
        :value="tab.value"
        @click="onClick(tab)"
      >
        {{ tab.name }}
      </v-tab>
    </v-tabs>
  </div>
</template>

<script setup lang="ts">
import { useTeamStore } from '~/stores/useTeamStore';

const teamStore = useTeamStore();
const tab = ref(null);

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

const onClick = (val) => {
  // teamStore.deleteTeamValue();
  teamStore.setTab(val.value);
  teamStore.fetchTeams();
}

</script>
