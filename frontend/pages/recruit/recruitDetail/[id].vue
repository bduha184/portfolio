<template>
  <div class="p-4">
    <v-container class="bg-white">
      <OrganismsCardsRecruitCardForDetail
      :header_img_path="recruit.getRecruitHeaderUrl"
      :thumbnail_path="recruit.getRecruitThumbnailUrl"
      :prof_thumbnail_path="test"
      :title="recruit.getRecruitTitle"
      :text="recruit.getRecruitText"
      />
    </v-container>
  </div>
</template>
<script setup lang="ts">
import {ref,onMounted} from 'vue';
import { useApiFetch } from '../../composables/useApiFetch';
import { useAuthStore } from '../../stores/useAuthStore';
import { useRecruitStore } from '../../stores/useRecruitStore';


const auth = useAuthStore();
const recruit = useRecruitStore();
onMounted(() => {
  const itemId = recruit.getRecruitItemId;
  recruit.fetchRecruitItem(itemId);
})
</script>

<style lang="scss" scoped>
.v-container {
padding-right: 0.5rem !important;
padding-left:0.5rem !important;
}
</style>
