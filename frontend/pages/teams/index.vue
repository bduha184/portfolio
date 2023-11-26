<template>
  <v-container>
    <OrganismsSearchFormKeywordsSearch />
    <!-- <OrganismsSearchFormMultipleSearch /> -->
    <MoleculesCountsTeamCount class="mt-4" :val="teamStore.getTeamCount" />
    <OrganismsTabsRecruitTab @emitSelectedTab="receiveSelectedTab" />
    <OrganismsCardsRecruitCardForList
      v-for="(item, id) in teams"
      :key="id"
      :header_img_path="item.header_img_path"
      :thumbnail_path="item.thumbnail_path"
      :team_name="item.team_name"
      :member="item.profiles_count"
      :introduction="item.introduction"
      :id="item.id"
      :tags="item.tags"
      :profiles="item.profiles"
      :areas="item.areas"
      :date_time="item.active_datetime"
    />
  </v-container>
</template>


<script setup lang="ts">
import type {Team} from "~/types";
import { useTeamStore } from "~/stores/useTeamStore";

const teamStore = useTeamStore();

const tab = ref<string>();
const teams:Team[]= ref(teamStore.getTeams);

const receiveSelectedTab = (val:string) => {
  tab.value = val;
};

watch(
  () => tab.value,
  () => {
    teamStore.setTab(tab.value);
    teamStore.fetchTeams();
  }
);

onMounted(() => {
  teamStore.fetchTeams();
});
</script>
