<template>
   <v-card  height="300px">
    <div class="relative z-0 h-[100px]">
      <AtomsImgsCardHeaderImg
        :disabled="false"
        :path="recruit.getRecruitHeaderUrl"
      >
        <AtomsImgsThumbnail
          :disabled="false"
          :path="recruit.getRecruitThumbnailUrl"
        />
      </AtomsImgsCardHeaderImg>
    </div>
   <v-card-title class="text-body-2 pl-20">
     <AtomsDecorationHeadline>
      {{ title }}
     </AtomsDecorationHeadline>
   </v-card-title>
   <v-card-text>
      {{ text }}
    </v-card-text>
   <GalleryLightGallery/>
   <TeamActivity/>
   <v-container class="text-center">
    <v-row>
      <v-col>
        <AtomsBtnsBaseBtn
        >
         このチームに参加する
       </AtomsBtnsBaseBtn>
      </v-col>
      <v-col>
        <AtomsBtnsBaseBtn setColor="orange">
         このチームに質問する
       </AtomsBtnsBaseBtn>
      </v-col>
    </v-row>
   </v-container>
   <RecruitProfile
   :prof_thumbnail_path="prof_thumbnail_path"
   />
  </v-card>
</template>

<script setup lang="ts">
import {onMounted} from 'vue';
import { useRecruitStore } from '../../../stores/useRecruitStore';
import {useRoute} from 'vue-router';

const router = useRoute();
const recruit = useRecruitStore();
onMounted(() => {
  const itemId = router.params.id;
  recruit.fetchRecruitItem(itemId);
})


</script>

<style lang="scss" scoped>
.v-card {
  & + & {
    margin-top: 1rem;
  }
}
  .v-avatar {
    position:absolute !important;
    bottom:-40px;
    left:20px;
    z-index: 10;
  }

  .v-responsive {
  position: unset !important;
}

</style>
