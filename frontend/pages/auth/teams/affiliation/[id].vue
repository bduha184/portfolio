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
          所属チーム詳細
        </h6>
        <p>
          <span class="font-weight-bold text-decoration-underline">
            {{auth.user.name}}
          </span>さんの所属チーム詳細ページです
        </p>
    </v-container>
    <div class="bg-white">
      <form>
        <AtomsDisplayFlashMessage :isShow="isShow">
          {{ flashMessage }}
        </AtomsDisplayFlashMessage>
        <OrganismsImgsCardProfile
          :pathHeader="teamItems.pathHeader"
          :pathThumbnail="teamItems.pathThumbnail"
          disabled="true"
        />
        <v-card-title class="w-60 text-body-2 text-left ml-auto">
          <AtomsTextsHeadLine class="w-100">
            {{ teamItems.teamName }}
          </AtomsTextsHeadLine>
        </v-card-title>
        <v-card-text>
          {{ teamItems.introduction }}
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
              :size=80
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
          v-if="auth.user.id == teamItems.user_id"
          />
          <v-card-text>

          </v-card-text>
        </v-container>
      </form>
    </div>
  </div>
</template>



<script setup lang="ts">
import { useApiFetch } from "~/composables/useApiFetch";
import { Url } from "~/constants/url";
import {Icons} from "~/constants/icons";
import { useTeamStore } from "~/stores/useTeamStore";
import { useAuthStore } from "~/stores/useAuthStore";

const auth = useAuthStore();
const router = useRoute();
const config = useRuntimeConfig();
const teamStore = useTeamStore();

const postImages = ref<string[]>([]);
const displayImages = ref<string[]>([]);
const isShow = ref<boolean>(false);
const flashMessage = ref<string | null>("");
const members = ref<string[]>([]);

const teamItems = ref({
  days: [],
  detailDays: "",
  areas: [],
  average: "",
  detailAreas: "",
  detailActivities: "",
  fromAge: "",
  headerImg: "",
  introduction: "",
  itemId: "",
  memberCount: 0,
  pathHeader: "",
  pathThumbnail: "",
  schedule: "",
  rides: [],
  teamName: "",
  teamUrl: "",
  thumbnail: "",
  toAge: "",
  urlHeaderImg: config.public.appURL + "/images/noimage.jpg",
  urlThumbnail: config.public.appURL + "/images/noimage.jpg",
  userId: "",
});


const receiveClick = () => {
  return navigateTo(Url.TEAMMESSAGES+teamItems.value.itemId);
}


onMounted(async () => {
  const team = teamStore.getTeams.find((team) => {
    return team.id == router.params.id;
  });
  console.log(teamStore.getTeams);
  if (team) {
    teamItems.value.itemId = team.id;
    teamItems.value.pathHeader =
      config.public.baseURL + "/storage/" + team.header_img_path;
    teamItems.value.pathThumbnail =
      config.public.baseURL + "/storage/" + team.thumbnail_path;
    teamItems.value.teamName = team.team_name;
    teamItems.value.introduction = team.introduction;

    team.profiles.forEach(proifile => {
      members.value.push(proifile);
    });
  }
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
