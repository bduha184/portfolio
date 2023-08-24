<template>
  <div class="p-4">
    <v-container class="bg-white">
      <FormKeywordsSearch/>
      <FormMultipleSearch/>
      <DisplayTeamCount/>
      <TabsRecruitTab/>
      <CardsRecruitCardForList
      v-for="(item,index ) in recruitItems"
      :key="index"
      :header_img_path="item.header_img_path"
      :thumbnail_path="item.thumbnail_path"
      :title="item.title"
      :text="item.text"
      />
    </v-container>
  </div>
</template>
<script setup lang="ts">
import {ref,onMounted} from 'vue';
import { useApiFetch } from '../../composables/useApiFetch';
import {useRecruitStore} from '../../stores/useRecruitStore';

const recruit = useRecruitStore();
const recruitItems  = recruit.items;

onMounted(()=>{
  
  recruit.fetchRecruitItems();
})

</script>

<style lang="scss" scoped>
.v-container {
padding-right: 0.5rem !important;
padding-left:0.5rem !important;
}
</style>
