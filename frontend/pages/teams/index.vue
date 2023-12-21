<template>
  <v-container class="bg-white">
    <OrganismsSearchFormSearch />
    <OrganismsSearchFormMultipleSearch />
    <MoleculesCountsTeamCount class="mt-4" :val="teamStore.getTeamCount" />
    <OrganismsTabsRecruitTab />
    <div class="item-wrapper bg-white">
      <OrganismsCardsRecruitCardForList
        v-for="(item, index) in teamStore.getTeams"
        :key="index"
        :headerImgPath="item.header_img_path"
        :thumbnailPath="item.thumbnail_path"
        :teamName="item.team_name"
        :member="item.profiles_count != 0 ? item.profiles_count  : 1"
        :introduction="item.introduction"
        :id="item.id"
        :rides="item.rides"
        :profiles="item.profiles"
        :areas="item.areas"
        :days="item.days"
        :detailDays="item.detail_day"
      />
      <p ref="observe"></p>
      <AtomsLoading v-show="teamStore.getLoading" />
    </div>
  </v-container>
</template>

<script setup lang="ts">
import { useTeamStore } from "~/stores/useTeamStore";

const teamStore = useTeamStore();
const observe = ref<Element | null>(null);

const callback = async (entries) => {
  const entry = entries[0];
  if (entry && entry.isIntersecting) {
    teamStore.fetchTeams();
  }
};

onMounted(() => {
  teamStore.getLoading;
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
~/types/props
