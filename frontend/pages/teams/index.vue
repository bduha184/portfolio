<template>
  <div class="p-4 bg-white">
      <OrganismsSearchFormKeywordsSearch />
      <!-- <OrganismsSearchFormMultipleSearch /> -->
      <MoleculesCountsTeamCount
        class="mt-4"
        :val="teamStore.getTeamCount"
      />
      <OrganismsTabsRecruitTab
      @emitSelectedTab="receiveSelectedTab"
      />
      <OrganismsCardsRecruitCardForList
        v-for="(item, id) in teams"
        :key="id"
        :header_img_path="item.header_img_path"
        :thumbnail_path="item.thumbnail_path"
        :team_name="item.team_name"
        :introduction="item.introduction"
        :id="item.id"
        :tags="item.tags"
        :profiles="item.profiles[0]"
        :areas="item.areas"
        :date_time="item.activeDateTime"
      />
  </div>
</template>
<script setup lang="ts">
import {useTeamStore} from "~/stores/useTeamStore";
import {ref,onMounted} from "#imports";
const teamStore = useTeamStore();

const tab = ref();

const teams = ref(teamStore.getTeams);

const receiveSelectedTab = (val)=> {
  tab.value = val;
}

onMounted(()=>{
  teamStore.fetchTeams();
});

</script>
