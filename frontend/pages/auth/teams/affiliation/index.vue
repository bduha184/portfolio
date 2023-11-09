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
            {{auth.user.name}}
          </span>さんの所属チーム一覧ページです
        </p>
    </v-container>
    <div class="p-4 bg-white">
        <OrganismsCardsRecruitCardForList
          v-for="(item, id) in teams"
          :key="id"
          :header_img_path="item.header_img_path"
          :thumbnail_path="item.thumbnail_path"
          :introduction="item.introduction"
          :team_name="item.team_name"
          :id="item.id"
          :profiles="item.profiles"
          :areas="item.areas"
          :date_time="item.activeDateTime"
          :auth=true
          />
      </div>
  </div>
</template>
<script setup lang="ts">
import { onBeforeMount, ref } from "#imports";
import {Icons} from '~/constants/icons';
import { useAuthStore } from "~/stores/useAuthStore";
const auth = useAuthStore();

const teams = ref([]);

onBeforeMount(async () => {
  const res = await useApiFetch("/api/team/auth");
  const items = res.data.value.affiliations;

  teams.value.push(...items);
});
</script>

<style lang="scss" scoped>
.v-container {
  padding-right: 0.5rem !important;
  padding-left: 0.5rem !important;
}
</style>
