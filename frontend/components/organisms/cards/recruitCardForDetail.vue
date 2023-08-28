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
    <GalleryLightGallery />
    <TeamActivity />
    <v-container class="text-center">
      <v-row>
        <v-col>
          <MoleculesBeforeLoginModal
          @emitClick="requestJoinTeam"
          :toggle="toggleRequest"
          >
        このチームに参加する
        </MoleculesBeforeLoginModal>
          <MoleculesAccordionsMessage
            class="text-center"
            :toggle="toggleRequest"
            @emitInput="receiveBody"
            @emitClick="receiveClick"
            placeholder="伝えたい内容、参加したい理由、等を記載してください"
            text="メッセージを送信する"
          >
          </MoleculesAccordionsMessage>
        </v-col>
        <v-col>
          <MoleculesBeforeLoginModal
          @emitClick="questionToTeam"
          :toggle="toggleQuestion"
          setColor="orange"
          >このチームに質問する</MoleculesBeforeLoginModal>
          <MoleculesAccordionsMessage
            class="text-center"
            setColor="orange"
            :toggle="toggleQuestion"
            placeholder="質問内容を記載してください"
            text="質問内容を送信する"
          >
          </MoleculesAccordionsMessage>
        </v-col>
      </v-row>
    </v-container>
    <RecruitProfile :prof_thumbnail_path="prof_thumbnail_path" />
  </v-card>
</template>

<script setup lang="ts">
import { useAuthStore } from "../../../stores/useAuthStore";
import { useMessageStore } from "../../../stores/useMessageStore";
import { ref, onMounted } from "vue";
import { useRecruitStore } from "../../../stores/useRecruitStore";
import { useRoute } from "vue-router";

const auth = useAuthStore();
const message = useMessageStore();
const router = useRoute();
const recruit = useRecruitStore();
onMounted(() => {
  const itemId = router.params.id;
  recruit.fetchRecruitItem(itemId);
});

const form = ref({
  comment:''
})

const toggleRequest = ref(false);
const toggleQuestion = ref(false);

const requestJoinTeam = () => {
  if (!auth.isLoggedIn) {
    toggleRequest.value = false;
  } else {
    toggleRequest.value = !toggleRequest.value;
  }
};
const questionToTeam = () => {
  if (!auth.isLoggedIn) {
    toggleQuestion.value = false;
  } else {
    toggleQuestion.value = !toggleQuestion.value;
  }
};
const receiveBody=(val)=> {
  form.value.comment = val;
}

const receiveClick=async()=>{
  await message.registerMessage(form.value);

}

</script>

<style lang="scss" scoped>
.v-card {
  & + & {
    margin-top: 1rem;
  }
}
.v-avatar {
  position: absolute !important;
  bottom: -40px;
  left: 20px;
  z-index: 10;
}

.v-responsive {
  position: unset !important;
}
</style>
