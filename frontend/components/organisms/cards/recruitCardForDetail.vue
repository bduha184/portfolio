<template>
  <v-card>
    <OrganismsImgsCardProfile
      :path_header="recruitItems.url_header_img"
      :path_thumbnail="recruitItems.url_thumbnail"
      disabled="disabled"
    />
    <v-card-title class="text-body-2 pl-20">
      <AtomsTextsHeadLine>
        {{ recruitItems.title }}
      </AtomsTextsHeadLine>
    </v-card-title>
    <v-card-text>
      {{ recruitItems.text }}
    </v-card-text>
    <OrganismsGalleryModal :images="images" />
    <OrganismsTeamActivity />
    <v-container class="text-center">
      <v-row>
        <v-col>
          <OrganismsModal
            @emitClick="requestJoinTeam"
            setColor="red"
          >
            このチームに参加する
          </OrganismsModal>
          <MoleculesAccordionsMessage
            class="text-center"
            :toggle="toggleRequest"
            @emitInput="receiveBody"
            @emitClick="receiveClick('join')"
            placeholder="伝えたい内容、参加したい理由、等を記載してください"
            text="メッセージを送信する"
          >
          </MoleculesAccordionsMessage>
        </v-col>
        <v-col>
          <OrganismsModal
            @emitClick="questionToTeam"
            setColor="orange"
          >
          このチームに質問する
          </OrganismsModal>
          <MoleculesAccordionsMessage
            class="text-center"
            setColor="orange"
            :toggle="toggleQuestion"
            @emitInput="receiveBody"
            @emitClick="receiveClick('que')"
            placeholder="質問内容を記載してください"
            text="質問内容を送信する"
          >
          </MoleculesAccordionsMessage>
        </v-col>
      </v-row>
    </v-container>
    <RecruitProfile :prof_thumbnail_path="prof_thumbnail_path" />
    <!-- </OrganismsCardsProfile> -->
  </v-card>
</template>

<script setup lang="ts">
import { ref, onBeforeMount,computed } from "#imports";
import { useAuthStore } from "../../../stores/useAuthStore";
import { useRoute } from "vue-router";
import { useRuntimeConfig } from "nuxt/app";

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
  title: "",
  text: "",
  url_header_img: config.public.appURL + "/images/noimage.jpg",
  url_thumbnail: config.public.appURL + "/images/noimage.jpg",
});

const images = ref([]);

const comments = ref("");

const toggleRequest = ref(false);
const toggleQuestion = ref(false);

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
    toggleQuestion.value = !toggleQuestion.value;
  }
};
const receiveBody = (val) => {
  comments.value = val;
};

const receiveClick = async (val) => {
  const dist = val == "join" ? "join" : "que";

  const data = {
    comments: comments.value,
    receiver_id: recruitItems.value.user_id,
    sender_id: auth.user.id,
    distinction: dist,
  };

  console.log(data);
  await useApiFetch("/sanctum/csrf-cookie");
  const res = await useApiFetch("/api/message/register", {
    method: "POST",
    body: data,
  });
};

onBeforeMount(async () => {
  const itemId = router.params.id;
  if (itemId) {
    await Promise.all([
      useApiFetch(`/api/recruit/${itemId}`),
      useApiFetch(`/api/images/${itemId}`),
    ]).then((resItems) => {
      resItems.forEach((item) => {
        const val = item.data.value;
        // console.log(val);
        if (val.data) {
          recruitItems.value.item_id = val.data.id;
          recruitItems.value.url_header_img =
            config.public.baseURL + "/storage/" + val.data.header_img_path;
          recruitItems.value.url_thumbnail =
            config.public.baseURL + "/storage/" + val.data.thumbnail_path;
          recruitItems.value.title = val.data.title;
          recruitItems.value.text = val.data.text;
          recruitItems.value.user_id = val.data.user_id;
        } else {
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
