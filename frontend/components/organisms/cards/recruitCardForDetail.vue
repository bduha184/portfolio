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
    <OrganismsGalleryModal
    :images="images"
    />
    <OrganismsRecruitsTeamInfo
      :member_count="teamItems.member_count"
      :average="teamItems.average"
      :from_age="teamItems.from_age"
      :to_age="teamItems.to_age"
      :tags="teamItems.tags"
      :areas="teamItems.areas"
      :detailActivities="teamItems.detailActivities"
      :detailAreas="teamItems.detailAreas"
      :activeDateTime="teamItems.activeDateTime"
      :teamUrl="teamItems.teamUrl"
    />
    <OrganismsRecruitsActivities :activities="teamItems.activities" />
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
    <OrganismsRecruitsRepresentative
    :user_id="rep.user_id"
    :path_thumbnail="rep.path_thumbnail"
    :introduction="rep.introduction"
    />
  </v-card>
</template>

<script setup lang="ts">
import { ref, onBeforeMount, computed } from "#imports";
import { useAuthStore } from "../../../stores/useAuthStore";
import { useRoute } from "vue-router";
import { useRuntimeConfig } from "nuxt/app";
import {Message} from '~/constants/flashMessage';
import { useFlashMessageStore } from "../../../stores/useFlashMessageStore";
import { useApiFetch } from "../../../composables/useApiFetch";

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
  detailAreas: "",
  member_count: 0,
  detailActivities: "",
  schedule: "",
  activeDateTime: "",
  teamUrl: "",
  url_header_img: config.public.appURL + "/images/noimage.jpg",
  url_thumbnail: config.public.appURL + "/images/noimage.jpg",
});

const rep = ref({
  user_id:'',
  path_thumbnail:'',
  introduction:'',
})

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

onBeforeMount(async () => {
  const itemId = router.params.id;
  if (itemId) {
    await Promise.all([
      useApiFetch(`/api/team/${itemId}`),
      useApiFetch(`/api/image/${itemId}`),
      ]).then((items) => {
      items.forEach((item) => {
        const val = item.data.value;
        console.log(val);
        if (val != null) {
          if (val.teamItem) {
            console.log(val);
            teamItems.value.item_id = val.teamItem.id;
            teamItems.value.url_header_img =
              config.public.baseURL +
              "/storage/" +
              val.teamItem.header_img_path;
            teamItems.value.url_thumbnail =
              config.public.baseURL + "/storage/" + val.teamItem.thumbnail_path;
            teamItems.value.team_name = val.teamItem.team_name;
            teamItems.value.introduction = val.teamItem.introduction;
            teamItems.value.average = val.teamItem.average;
            teamItems.value.from_age = val.teamItem.from_age;
            teamItems.value.to_age = val.teamItem.to_age;
            teamItems.value.detailAreas = val.teamItem.detailAreas;
            teamItems.value.detailActivities = val.teamItem.detailActivities;
            teamItems.value.activeDateTime = val.teamItem.activeDateTime;
            teamItems.value.teamUrl = val.teamItem.teamUrl;
            teamItems.value.schedule = val.teamItem.schedule;
            teamItems.value.user_id = val.teamItem.user_id;
          }
          if (val.members) {
            teamItems.value.member_count = val.members.length;
          }
          if (val.profile) {
            rep.value.path_thumbnail =config.public.baseURL + "/storage/" +  val.profile.thumbnail_path;
            rep.value.introduction = val.profile.introduction;
            rep.value.user_id = val.profile.user_id;
          }
          if (val.tags) {
            val.tags.forEach((tag) => {
              teamItems.value.tags.push(tag.name);
            });
          }
          if (val.areas) {
            val.areas.forEach((area) => {
              teamItems.value.areas.push(area.name);
            });
          }

          if (val.images) {
            val.images.forEach((image) => {
              images.value.push(
                config.public.baseURL + "/storage/" + image
              );
            });
          }
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
