<template>
  <div>
    <v-container class="bg-white mb-2">
      <h6 class="text-h6">
        <AtomsIconsSquare
          :name="Icons.AFFILIATION"
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
        :auth=true
      />
      <p ref="observe"></p>
      <AtomsLoading v-show="teamStore.getLoading" />
    </div>
  </div>
</template>

<script setup lang="ts">
import { Icons } from "~/constants/icons";
import { useAuthStore } from "~/stores/useAuthStore";
import { useTeamStore } from "~/stores/useTeamStore";
const auth = useAuthStore();

const teamStore = useTeamStore();

const observe = ref<Element | null>(null);

const callback = async (entries) => {
  const entry = entries[0];
  if (entry && entry.isIntersecting) {
    teamStore.fetchAffiliationTeams();
  }
};

onMounted(async () => {
  teamStore.getLoading;
  teamStore.deleteTeamValue();
  const observer = new IntersectionObserver(callback);
  observer.observe(observe.value);
});
</script>

<style lang="scss" scoped>
.v-container {
  padding-right: 0.5rem !important;
  padding-left: 0.5rem !important;
}
</style>
