<template>
  <div class="p-4">
    <v-container class="bg-white">
      <FormKeywordsSearch />
      <FormMultipleSearch />
      <MoleculesCountsTeamCount
        class="mt-4"
        :val="recruitItems.itemCount"
      />
      <OrganismsTabsRecruitTab />
      <OrganismsCardsRecruitCardForList
        v-for="(item, id) in recruitItems.items"
        :key="id"
        :header_img_path="item.header_img_path"
        :thumbnail_path="item.thumbnail_path"
        :title="item.title"
        :text="item.text"
        :id="item.id"
      />
    </v-container>
  </div>
</template>
<script setup lang="ts">
import { onBeforeMount, ref } from "vue";

const recruitItems = ref({
  items: [],
  itemCount: 0,
});

onBeforeMount(async () => {
  const res = await useApiFetch("/api/recruit/");
  const items = res.data.value;
  recruitItems.value.items.push(...items);
  recruitItems.value.itemCount = res.data.value.length;
});
</script>

<style lang="scss" scoped>
.v-container {
  padding-right: 0.5rem !important;
  padding-left: 0.5rem !important;
}
</style>
