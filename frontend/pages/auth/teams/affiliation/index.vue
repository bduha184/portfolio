<template>
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
</template>
<script setup lang="ts">
import { onBeforeMount, ref } from "vue";

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
