<template>
  <v-card>
    <OrganismsImgsCardProfile
      :path_header="teamItems.url_header_img"
      :path_thumbnail="teamItems.url_thumbnail"
      disabled="disabled"
    />
    <v-card-title class="text-body-2 pl-20">
      <AtomsTextsHeadLine>
        {{ teamItems.team_name }}
      </AtomsTextsHeadLine>
    </v-card-title>
    <v-card-text>
      {{ teamItems.introduction }}
    </v-card-text>
    <OrganismsGallery :images="gallery.getImages" />
    <OrganismsRecruitsTeamInfo
      :member_count="teamItems.member_count"
      :average="teamItems.average"
      :from_age="teamItems.from_age"
      :to_age="teamItems.to_age"
      :tags="teamItems.tags"
      :areas="teamItems.areas"
      :detail_activities="teamItems.detail_activities"
      :detail_areas="teamItems.detail_areas"
      :active_datetime="teamItems.active_datetime"
      :team_url="teamItems.team_url"
    />
    <OrganismsRecruitsActivities :activities="teamItems.activities" />
    <v-container class="text-center">
      <v-row>
        <v-col>
          <OrganismsModal
            color="info"
            :userId="rep.user_id"
            placeholder="伝えたい内容、参加したい理由、等を記載してください"
            text="メッセージを送信する"
            :disabled="rep.user_id == auth.user?.id"
            @emitMessages="receiveMessages"
          >
            このチームに参加する
          </OrganismsModal>
        </v-col>
        <v-col>
          <OrganismsModal
            color="secondary"
            :userId="rep.user_id"
            placeholder="質問内容を記載してください"
            text="質問内容を送信する"
            :disabled="rep.user_id == auth.user?.id"
            @emitMessages="receiveMessages"
          >
            このチームに質問する
          </OrganismsModal>
        </v-col>
      </v-row>
    </v-container>

    <OrganismsRecruitsRepresentative
      :user_id="rep.user_id"
      :path_thumbnail="rep.path_thumbnail"
      :introduction="rep.introduction"
    />
  </v-card>
</template>


<script setup lang="ts">
import { useAuthStore } from "~/stores/useAuthStore";
import { Message } from "~/constants/flashMessage";
import { useFlashMessageStore } from "~/stores/useFlashMessageStore";
import { useApiFetch } from "~/composables/useApiFetch";
import { useGalleryStore } from "~/stores/useGalleryStore";

const gallery = useGalleryStore();
const auth = useAuthStore();
const router = useRoute();
const config = useRuntimeConfig();
const flashMessage = useFlashMessageStore();

const teamItems = ref({
  path_header: "",
  path_thumbnail: "",
  item_id: "",
  user_id: "",
  header_img: "",
  thumbnail: "",
  team_name: "",
  introduction: "",
  average: "",
  from_age: "",
  to_age: "",
  tags: [],
  areas: [],
  detail_areas: "",
  member_count: 0,
  detail_activities: "",
  schedule: "",
  active_datetime: "",
  team_url: "",
  url_header_img: config.public.appURL + "/images/noimage.jpg",
  url_thumbnail: config.public.appURL + "/images/noimage.jpg",
});

const rep = ref({
  user_id: "",
  path_thumbnail: "",
  introduction: "",
});
const comment = ref("");
const joinRequest = ref(false);

const sender_id = auth.user?.id;
const receiveMessages = async (val) => {
  joinRequest.value = true;
  comment.value = val;
  const messageData = {
    comment: comment.value,
    receiver_id: teamItems.value.user_id,
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

(async () => {
  const itemId = router.params.id;
  const userId = router.query.user;
  gallery.fetchGalleryImages(userId);
  if (itemId) {
    const res = await useApiFetch(`/api/team/${itemId}`);
    if (res.error.value == null) {
      const val = res.data.value;
      console.log(val);
      if (val != null) {
        if (val.teamInfo) {
          console.log(val);
          teamItems.value.item_id = val.teamInfo.id;
          teamItems.value.url_header_img =
            config.public.baseURL + "/storage/" + val.teamInfo.header_img_path;
          teamItems.value.url_thumbnail =
            config.public.baseURL + "/storage/" + val.teamInfo.thumbnail_path;
          teamItems.value.team_name = val.teamInfo.team_name;
          teamItems.value.introduction = val.teamInfo.introduction;
          teamItems.value.average = val.teamInfo.average;
          teamItems.value.from_age = val.teamInfo.from_age;
          teamItems.value.to_age = val.teamInfo.to_age;
          teamItems.value.detail_areas = val.teamInfo.detail_areas;
          teamItems.value.detail_activities = val.teamInfo.detail_activities;
          teamItems.value.active_datetime = val.teamInfo.active_datetime;
          teamItems.value.team_url = val.teamInfo.team_url;
          teamItems.value.schedule = val.teamInfo.schedule;
          teamItems.value.user_id = val.teamInfo.user_id;
          teamItems.value.member_count = val.teamInfo.profiles_count;
          val.teamInfo.tags.forEach((tag) => {
            teamItems.value.tags.push(tag.name);
          });
          val.teamInfo.areas.forEach((area) => {
            teamItems.value.areas.push(area.name);
          });
          rep.value.path_thumbnail =
            config.public.baseURL + "/storage/" + val.teamInfo.profiles[0].thumbnail_path;
          rep.value.introduction = val.teamInfo.profiles[0].introduction;
          rep.value.user_id = val.teamInfo.profiles[0].user_id;
        }
      }
    }
  }
})();
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
