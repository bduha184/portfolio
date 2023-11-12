<template>
  <div class="p-4 bg-white">
      <FormKeywordsSearch />
      <FormMultipleSearch />
      <MoleculesCountsTeamCount
        class="mt-4"
        :val="teamItems.itemCount"
      />
      <OrganismsTabsRecruitTab />
      <OrganismsCardsRecruitCardForList
        v-for="(item, id) in teamItems.items"
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
import { onBeforeMount, ref } from "vue";

const teamItems = ref({
  items: [],
  itemCount: 0,
});

onBeforeMount(async () => {
  const res = await useApiFetch("/api/team/");
  if(res){
    console.log(res);
    const items = res.data.value.teams;
    teamItems.value.items.push(...items);
    teamItems.value.itemCount = items.length;

  }
});
</script>

<style lang="scss" scoped>
.v-container {
  padding-right: 0.5rem !important;
  padding-left: 0.5rem !important;
}
</style>
