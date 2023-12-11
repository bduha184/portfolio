<template>
  <v-card>
    <OrganismsImgsCardProfile
      :pathHeader="teamItems.pathHeader"
      :pathThumbnail="teamItems.pathThumbnail"
      disabled="disabled"
    />
    <v-card-title class="text-body-2 pl-20">
      <AtomsTextsHeadLine>
        {{ teamItems.teamName }}
      </AtomsTextsHeadLine>
    </v-card-title>
    <v-card-text>
      {{ teamItems.introduction }}
    </v-card-text>
    <OrganismsGallery :images="gallery.getImages" />
    <OrganismsRecruitsTeamInfo
      :memberCount="teamItems.memberCount"
      :average="teamItems.average"
      :fromAge="teamItems.fromAge"
      :toAge="teamItems.toAge"
      :rides="teamItems.rides"
      :areas="teamItems.areas"
      :days="teamItems.days"
      :detailActivities="teamItems.detailActivities"
      :detailAreas="teamItems.detailAreas"
      :detailDays="teamItems.detailDays"
      :teamUrl="teamItems.teamUrl"
    />
    <OrganismsRecruitsActivities :activities="teamItems.activities" />
    <v-container class="text-center">
      <v-row>
        <v-col>
          <OrganismsModal
            color="info"
            :userId="rep.userId"
            placeholder="伝えたい内容、参加したい理由、等を記載してください"
            text="メッセージを送信する"
            :disabled="rep.userId == auth.user?.id"
            @emitMessages="receiveMessages"
          >
            このチームに参加する
          </OrganismsModal>
        </v-col>
        <v-col>
          <OrganismsModal
            color="secondary"
            :userId="rep.userId"
            placeholder="質問内容を記載してください"
            text="質問内容を送信する"
            :disabled="rep.userId == auth.user?.id"
            @emitMessages="receiveMessages"
          >
            このチームに質問する
          </OrganismsModal>
        </v-col>
      </v-row>
    </v-container>

    <!-- <OrganismsRecruitsRepresentative
      :user_id="rep.userId"
      :path_thumbnail="rep.pathThumbnail"
      :introduction="rep.introduction"
    /> -->
  </v-card>
</template>

<script setup lang="ts">
import { useAuthStore } from "~/stores/useAuthStore";
import { Message } from "~/constants/flashMessage";
import { useFlashMessageStore } from "~/stores/useFlashMessageStore";
import { useApiFetch } from "~/composables/useApiFetch";
import { useGalleryStore } from "~/stores/useGalleryStore";
import { useTeamStore } from "~/stores/useTeamStore";

const gallery = useGalleryStore();
const auth = useAuthStore();
const router = useRoute();
const teamStore = useTeamStore();
const itemId = router.params.id;
const config = useRuntimeConfig();
const flashMessage = useFlashMessageStore();

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

const rep = ref({
  pathThumbnail: "",
  introduction: "",
  userId: "",
});

const comment = ref("");
const joinRequest = ref(false);

const sender_id = auth.user?.id;
const receiveMessages = async (val) => {
  joinRequest.value = true;
  comment.value = val;
  const messageData = {
    comment: comment.value,
    receiver_id: teamItems.value.userId,
    sender_id: auth.user?.id,
  };

  const profileData = {
    request_flg: joinRequest.value,
    team_id: router.params.id,
  };

  await useApiFetch("/sanctum/csrf-cookie");
  await Promise.all([
    useApiFetch("/api/message/register", {
      method: "POST",
      body: messageData,
    }),
    useApiFetch(`/api/profile/${sender_id}`, {
      method: "POST",
      body: profileData,
      headers: {
        "X-HTTP-Method-Override": "PUT",
      },
    }),
  ]).then((res) => {
    console.log(res);
    if (res[0].error.value != null && res[0].error.value != null) {
      return flashMessage.setMessage(Message.SENDMESSAGEERROR, "error", 6000);
    }

    teamItems.value.item_id = res[0].data.value;
    return flashMessage.setMessage(Message.SENDMESSAGE);
  });
};

onMounted(() => {
  const team = teamStore.getTeams.find((team) => {
    return team.id == router.params.id;
  });

  if (team) {
    teamItems.value.itemId = team.id;
    teamItems.value.pathHeader =
      config.public.baseURL + "/storage/" + team.header_img_path;
    teamItems.value.pathThumbnail =
      config.public.baseURL + "/storage/" + team.thumbnail_path;
    teamItems.value.teamName = team.team_name;
    teamItems.value.introduction = team.introduction;
    teamItems.value.average = team.average;
    teamItems.value.fromAge = team.from_age;
    teamItems.value.toAge = team.to_age;
    teamItems.value.detailAreas = team.detail_area;
    teamItems.value.detailActivities = team.detail_activity;
    teamItems.value.detailDays = team.detail_day;
    teamItems.value.teamUrl = team.team_url;
    teamItems.value.schedule = team.schedule;
    teamItems.value.userId = team.user_id;
    teamItems.value.memberCount = team.profiles_count;
    team.rides.forEach((ride) => {
      teamItems.value.rides.push(ride.name);
    });
    team.areas.forEach((area) => {
      teamItems.value.areas.push(area.name);
    });
    team.days.forEach((day) => {
      teamItems.value.days.push(day.name);
    });
    // rep.value.pathThumbnail = config.public.baseURL + "/storage/" +  team.profiles[0].thumbnail_path;
    // rep.value.introduction = team.profiles[0].introduction;
    // rep.value.userId = team.profiles[0].user_id;
  }
});
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
