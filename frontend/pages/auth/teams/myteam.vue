<template>
  <div>
    <v-container class="bg-white mb-2">
      <h6 class="text-h6">
          <AtomsIconsSquare
          :name="Icons.DASHBOARD"
          color="white"
          class="bg-red p-3 rounded"
          size="50"
          />
          マイチーム
        </h6>
        <p>
          <span class="font-weight-bold text-decoration-underline">
            {{auth.user.name}}
          </span>さんのマイチーム編集ページです
        </p>
    </v-container>
    <div class="bg-white">
      <form>
        <AtomsDisplayFlashMessage :isShow="isShow">
          {{ flashMessage }}
        </AtomsDisplayFlashMessage>
        <OrganismsImgsCardProfile
      :pathHeader="teamStore.getTeamDetail.urlHeaderImg"
      :pathThumbnail="teamStore.getTeamDetail.urlThumbnail"
    />
        <v-card-title class="w-60 text-body-2 text-left ml-auto">
          <AtomsTextsHeadLine class="w-100">
            {{ teamStore.getTeamDetail.teamName }}
          </AtomsTextsHeadLine>
        </v-card-title>
        <v-card-text>
          {{ teamStore.getTeamDetail.introduction }}
        </v-card-text>
        <AtomsBtnsBaseBtn
          width="16rem"
          height="60"
          color="blue"
          class="my-4 d-block mx-auto"
          @emitClick="receiveClick"
        >
          チームチャット
        </AtomsBtnsBaseBtn>
        <v-container>
          <AtomsTextsHeadLine class="w-100"> チームメンバー </AtomsTextsHeadLine>
          <v-row>
            <v-col cols="3"
            v-for="(member, i) in members"
            :key="i">
            <NuxtLink
            :to="Url.PROFILE+'/'+member.user_id"
            >
              <v-avatar
              class="w-100 h-100"
              >
              <AtomsImgs
              :src="config.public.baseURL +'/storage/'+ member.thumbnail_path"
              />
            </v-avatar>
            </NuxtLink>
            </v-col>
          </v-row>
        </v-container>
        <v-container>
          <AtomsTextsHeadLine class="w-100"> 今後の予定 </AtomsTextsHeadLine>
          <AtomsTextAreas
          class="mt-2"
          v-if="auth.user.id == teamStore.getTeamDetail.userId"
          />
          <v-card-text>

          </v-card-text>
        </v-container>
      </form>
    </div>
  </div>
</template>



<script setup lang="ts">
import { Url } from "~/constants/url";
import {Icons} from "~/constants/icons";
import { useAuthStore } from "~/stores/useAuthStore";
import {useTeamStore} from "~/stores/useTeamStore";

const auth = useAuthStore();
const config = useRuntimeConfig();
const teamStore = useTeamStore();

const postImages = ref<string[]>([]);
const displayImages = ref<string[]>([]);
const isShow = ref<boolean>(false);
const flashMessage = ref<string | null>("");
const members = ref<string[]>([]);

const receiveClick = () => {
  return navigateTo(Url.TEAMMESSAGES+teamItems.value.id);
}


onMounted(async () => {
  teamStore.fetchMyTeams();

});
</script>


<style lang="scss" scoped>
.v-card {
  overflow: hidden !important;
  border-radius: 10px;
}

.v-responsive {
  position: unset !important;
}
.v-file-input {
  opacity: 0;
  position: absolute !important;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
  height: 100%;
  z-index: 10;
  background: red;
}
</style>
