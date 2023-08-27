<template>
   <v-card>
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
      {{ recruit.getRecruitTitle }}
     </AtomsDecorationHeadline>
   </v-card-title>
   <v-card-text>
      {{ recruit.getRecruitText }}
    </v-card-text>
   <GalleryLightGallery/>
   <TeamActivity/>
   <v-container class="text-center">
    <v-row>
      <v-col>
        <AtomsBtnsBaseBtn
        @click="requestJoinTeam"
        >
         このチームに参加する
       </AtomsBtnsBaseBtn>
       <MoleculesAccordionsMessage
       class="text-center"
       :toggle="toggleRequest"
       placeholder="伝えたい内容、参加したい理由、等を記載してください"
       text="メッセージを送信する"
       >
       </MoleculesAccordionsMessage>
      </v-col>
      <v-col>
        <AtomsBtnsBaseBtn
        @click="questionToTeam"
        setColor="orange">
         このチームに質問する
       </AtomsBtnsBaseBtn>
       <MoleculesAccordionsMessage
       class="text-center"
       :setColor="orange"
       :toggle="toggleQuestion"
       placeholder="質問内容を記載してください"
       text="質問内容を送信する"
       >
       </MoleculesAccordionsMessage>
      </v-col>
    </v-row>
   </v-container>
   <RecruitProfile
   :prof_thumbnail_path="prof_thumbnail_path"
   />
  </v-card>
</template>

<script setup lang="ts">
import {ref,onMounted} from 'vue';
import { useRecruitStore } from '../../../stores/useRecruitStore';
import {useRoute} from 'vue-router';

const router = useRoute();
const recruit = useRecruitStore();
onMounted(() => {
  const itemId = router.params.id;
  recruit.fetchRecruitItem(itemId);
})

const toggleRequest = ref(false);
const toggleQuestion = ref(false);

const requestJoinTeam = () => {
  toggleRequest.value = !toggleRequest.value;
}
const questionToTeam = () => {
  toggleQuestion.value = !toggleQuestion.value;
}


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
