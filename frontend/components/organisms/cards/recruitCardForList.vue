<template>
  <v-card
  @click="onClick"
  height="300px"
  >
  <div class="relative z-0 h-[100px]">
      <AtomsImgsCardHeaderImg
        @emitInput = 'receiveImg'
        :path="recruit.getRecruitHeaderUrl"
      >
        <AtomsImgsThumbnail
        @emitInput = 'receiveThumbnail'
        :path="recruit.getRecruitThumbnailUrl"
        />
      </AtomsImgsCardHeaderImg>
    </div>
    <v-card-title class="w-60 text-body-2 text-left ml-auto">
      <AtomsInput
      class="pl-2 leading-snug relative before:absolute before:left-0 before:top-0 before:h-full before:w-[3px] before:bg-orange-600 z-100"
      placeholder="チーム名"
      type="text"
      @emitInput="receiveTeamName"
      :val="recruit.getRecruitTitle"
      />
    </v-card-title>
    <v-card-text>
      <AtomsTextAreas
      placeholder="本文"
      @emitInput="receiveTeamIntroduce"
      :body="recruit.getRecruitText"
      />
    </v-card-text>
  </v-card>
</template>

<script setup lang="ts">
import { navigateTo,useRuntimeConfig } from 'nuxt/app';
import { useRecruitStore } from '../../../stores/useRecruitStore';

const props = defineProps({
  header_img_path:String,
  thumbnail_path:String,
  title:String,
  text:String
})

const recruit = useRecruitStore();

const config = useRuntimeConfig();

const onClick = () => {
  return navigateTo('/recruit/recruitdetail');
}


</script>

<style lang="scss" scoped>
.v-card {
  overflow:visible !important;
  position: relative;
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
