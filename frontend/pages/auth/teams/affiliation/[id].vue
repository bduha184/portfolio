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
          @emitInput="receiveProfileImage"
          :path_header="teamItems.url_header_img"
          :path_thumbnail="teamItems.url_thumbnail"
          disabled="true"
        />
        <v-card-title class="w-60 text-body-2 text-left ml-auto">
          <AtomsTextsHeadLine class="w-100">
            {{ teamItems.team_name }}
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
              size="80"
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
import {
  useRuntimeConfig,
  navigateTo,
  useRoute,
  clearNuxtData,
} from "nuxt/app";
import { Message } from "~/constants/flashMessage";
import { useApiFetch } from "~/composables/useApiFetch";
import { ref, onBeforeMount, computed } from "#imports";
import { Url } from "~/constants/url";
import { useAuthStore } from "~/stores/useAuthStore";
import {Icons} from '~/constants/icons';
// import { useRoute } from "vue-router";

const auth = useAuthStore();
const router = useRoute();
const config = useRuntimeConfig();

const postImages = ref([]);
const displayImages = ref([]);
const isShow = ref(false);
const flashMessage = ref("");
const members = ref([]);

const teamItems = ref({
  id: "",
  items: [],
  item: "",
  itemCount: 0,
  path_header: "",
  path_thumbnail: "",
  user_id: "",
  header_img: "",
  thumbnail: "",
  team_name: "",
  introduction: "",
  activities: "",
  url_header_img: config.public.appURL + "/images/noimage.jpg",
  url_thumbnail: config.public.appURL + "/images/noimage.jpg",
});


const receiveClick = () => {
  return navigateTo(Url.TEAMMESSAGES+teamItems.value.id);
}


onBeforeMount(async () => {
  const itemId = router.params.id;
  if (itemId) {
    await Promise.all([
      useApiFetch(`/api/team/${itemId}`),
      useApiFetch(`/api/image/${itemId}`),
    ]).then((responses) => {
      responses.forEach((res) => {
        const val = res.data.value;
        console.log(val);
        if (val != null) {
          if (val.teamItem) {
            teamItems.value.id = val.teamItem.id;
            teamItems.value.user_id = val.teamItem.user_id;
            teamItems.value.url_header_img =
              config.public.baseURL +
              "/storage/" +
              val.teamItem.header_img_path;
            teamItems.value.url_thumbnail =
              config.public.baseURL + "/storage/" + val.teamItem.thumbnail_path;
            teamItems.value.introduction = val.teamItem.introduction;
            teamItems.value.team_name = val.teamItem.team_name;
            teamItems.value.activities = val.teamItem.activities;
            teamItems.value.user_id = val.teamItem.user_id;
          }

          if (val.members) {
            members.value.push(...val.members);
          }

          if (val.images) {
            val.images.forEach((image) => {
              postImages.value.push(image);
              displayImages.value.push(
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
