<template>
  <div class="p-4 bg-white">
      <OrganismsCardsRecruitCardForList
        v-for="(item, id) in recruitItems"
        :key="id"
        :header_img_path="item.header_img_path"
        :thumbnail_path="item.thumbnail_path"
        :introduction="item.introduction"
        :team_name="item.team_name"
        :id="item.id"
      />
  </div>
</template>
<script setup lang="ts">
import { onBeforeMount, ref } from "vue";

const recruitItems = ref([]);

onBeforeMount(async () => {
  const select = {
    'kind':'auth'
  }
  const res = await useApiFetch("/api/team/auth");
  console.log(res);
  const items = res.data.value.affiliations;

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
