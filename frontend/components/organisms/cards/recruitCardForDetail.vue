<template>
  <v-card>
    <OrganismsImgsCardProfile
      :path_header="recruitItems.url_header_img"
      :path_thumbnail="recruitItems.url_thumbnail"
      disabled="disabled"
    />
    <v-card-title class="text-body-2 pl-20">
      <AtomsTextsHeadLine>
        {{ recruitItems.team_name }}
      </AtomsTextsHeadLine>
    </v-card-title>
    <v-card-text>
      {{ recruitItems.introduction }}
    </v-card-text>
    <OrganismsGalleryModal :images="images" />
    <OrganismsRecruitsTeamInfo :activities="recruitItems.activities" />
    <OrganismsRecruitsActivities :activities="recruitItems.activities" />
    <v-container class="text-center">
      <v-row>
        <v-col>
          <OrganismsModal @emitAccordion="requestJoinTeam" color="info">
            このチームに参加する
          </OrganismsModal>
          <MoleculesAccordionsMessage
            class="text-center"
            :toggle="toggleRequest"
            @emitInput="receiveBody"
            @emitClick="
              joinRequest = true;
              receiveClick();
            "
            placeholder="伝えたい内容、参加したい理由、等を記載してください"
            text="メッセージを送信する"
          >
          </MoleculesAccordionsMessage>
        </v-col>
        <v-col>
          <OrganismsModal @emitAccordion="questionToTeam" color="secondary">
            このチームに質問する
          </OrganismsModal>
          <MoleculesAccordionsMessage
            class="text-center"
            setColor="orange"
            :toggle="toggleQuestion"
            @emitInput="receiveBody"
            @emitClick="receiveClick"
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
import { ref, onBeforeMount, computed } from "#imports";
import { useAuthStore } from "../../../stores/useAuthStore";
import { useRoute } from "vue-router";
import { useRuntimeConfig } from "nuxt/app";
import { useApiFetch } from "../../../composables/useApiFetch";

const auth = useAuthStore();
const router = useRoute();
const config = useRuntimeConfig();

const recruitItems = ref({
  items: [],
  item: "",
  itemCount: 0,
  path_header: "",
  path_thumbnail: "",
  item_id: "",
  user_id: "",
  header_img: "",
  thumbnail: "",
  team_name: "",
  introduction: "",
  activities: "",
  url_header_img: config.public.appURL + "/images/noimage.jpg",
  url_thumbnail: config.public.appURL + "/images/noimage.jpg",
});

const images = ref([]);

const comments = ref("");
const joinRequest = ref(false);

const toggleRequest = ref(false);
const toggleQuestion = ref(false);

const sender_id = auth.user?.id;

const requestJoinTeam = () => {
  if (!auth.isLoggedIn) {
    toggleRequest.value = false;
  } else {
    toggleRequest.value = true;
  }
};
const questionToTeam = () => {
  if (!auth.isLoggedIn) {
    toggleQuestion.value = false;
  } else {
    toggleQuestion.value = true;
  }
};
const receiveBody = (val) => {
  comments.value = val;
};

const receiveClick = async () => {
  const messageData = {
    comments: comments.value,
    receiver_id: recruitItems.value.user_id,
    sender_id: auth.user?.id,
  };

  const profileData = {
    request_flg: joinRequest.value,
  };

  await Promise.all([
    useApiFetch("/sanctum/csrf-cookie"),
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
  });
};

onBeforeMount(async () => {
  const itemId = router.params.id;
  if (itemId) {
    await Promise.all([
      useApiFetch(`/api/team/${itemId}`),
      useApiFetch(`/api/image/${itemId}`),
    ]).then((resItems) => {
      resItems.forEach((item) => {
        const val = item.data.value;
        console.log(val);
        if (val.teamItem) {
          recruitItems.value.item_id = val.teamItem.id;
          recruitItems.value.url_header_img =
            config.public.baseURL + "/storage/" + val.teamItem.header_img_path;
          recruitItems.value.url_thumbnail =
            config.public.baseURL + "/storage/" + val.teamItem.thumbnail_path;
          recruitItems.value.team_name = val.teamItem.team_name;
          recruitItems.value.introduction = val.teamItem.introduction;
          recruitItems.value.activities = val.teamItem.activities;
          recruitItems.value.user_id = val.dteamItemata.user_id;
        }
        if (val.images) {
          val.images.forEach((image) => {
            images.value.push(config.public.baseURL + "/storage/" + image);
          });
        }
      });
    });
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
