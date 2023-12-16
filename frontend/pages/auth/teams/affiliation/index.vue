<template>
  <div>
    <v-container class="bg-white mb-2">
      <h6 class="text-h6">
        <AtomsIconsSquare
          :name="Icons.DASHBOARD"
          color="white"
          class="bg-red p-3 rounded"
          size="50"
        />
        所属チーム一覧
      </h6>
      <p>
        <span class="font-weight-bold text-decoration-underline">
          {{ auth.user.name }} </span
        >さんの所属チーム一覧ページです
      </p>
    </v-container>
    <div class="p-4 bg-white">
      <OrganismsCardsRecruitCardForList
        v-for="(item, id) in teams"
        :key="id"
        :headerImgPath="item.header_img_path"
        :thumbnailPath="item.thumbnail_path"
        :introduction="item.introduction"
        :teamName="item.team_name"
        :member="item.profiles_count"
        :id="item.id"
        :profiles="item.profiles"
        :areas="item.areas"
        :days="item.days"
        :rides="item.rides"
        :auth="true"
      />
    </div>
  </div>
</template>

<script setup lang="ts">
import type { Team } from "~/types";
import { Icons } from "~/constants/icons";
import { useAuthStore } from "~/stores/useAuthStore";
import { useTeamStore } from "~/stores/useTeamStore";
const auth = useAuthStore();

const teamStore = useTeamStore();

const teams: Team[] = ref(teamStore.getTeams);

onMounted(async () => {
  teamStore.fetchAffiliationTeams();
});
</script>

<style lang="scss" scoped>
.v-container {
  padding-right: 0.5rem !important;
  padding-left: 0.5rem !important;
}
</style>
~/types/types ~/types/types
