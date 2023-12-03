<template>
  <v-container class="bg-white">
    <OrganismsSearchFormSearch />
    <OrganismsSearchFormMultipleSearch />
    <MoleculesCountsTeamCount class="mt-4" :val="teamStore.getTeamCount" />
    <OrganismsTabsRecruitTab @emitSelectedTab="receiveSelectedTab" />
    <div
    class="item-wrapper bg-white"
    >
    <OrganismsCardsRecruitCardForList
    v-for="(item, index) in teams"
    :key="index"
    :headerImgPath="item.header_img_path"
    :thumbnailPath="item.thumbnail_path"
    :teamName="item.team_name"
    :member="item.profiles_count"
    :introduction="item.introduction"
    :id="item.id"
    :tags="item.tags"
    :profiles="item.profiles"
    :areas="item.areas"
    :activeDate="item.active_date"
    :activeDateDetail="item.active_date_detail"
    />
    <AtomsLoading
    v-show="teamStore.getLoading"
    />
  </div>
  <p ref="observe"></p>
  </v-container>
</template>

<script setup lang="ts">
import type { Team } from "~/types";
import { useTeamStore } from "~/stores/useTeamStore";

const teamStore = useTeamStore();
const tab = ref<string>();
const observe = ref<Element | null>(null);
const teams: Team[] = ref(teamStore.getTeams);

const receiveSelectedTab = (val: string) => {
  tab.value = val;
};

watch(
  () => tab.value,
  () => {
    teamStore.setTab(tab.value);
    teamStore.fetchTeams();
  }
);

const callback = async (entries) => {
  const entry = entries[0];
  if (entry && entry.isIntersecting) {
  teamStore.fetchAllTeams();
  }
};

onMounted(() => {
  teamStore.getLoading;
  teamStore.fetchAllTeams();
    const observer = new IntersectionObserver(callback);
    observer.observe(observe.value);
});

</script>

<style scoped lang="scss">

.item-wrapper {
  min-height: 1000px;
  width: 100%;

}
</style>
