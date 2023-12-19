<template>
  <div>
    <OrganismsImgsCardProfile
      :pathHeader="form.urlHeaderImg"
      :pathThumbnail="form.urlThumbnail"
    />
    <!-- {{ teamStore.getTeams }} -->
    <v-card-title class="w-60 text-body-2 text-left ml-auto">
      <AtomsTextsHeadLine>
        {{ form.name }}
      </AtomsTextsHeadLine>
    </v-card-title>
    <v-card-text>
      {{ form.introduction }}
    </v-card-text>
  </div>
</template>

<script setup lang="ts">
import { useApiFetch } from "~/composables/useApiFetch";
import { useTeamStore } from "~/stores/useTeamStore";

const teamStore = useTeamStore();

const config = useRuntimeConfig();
const router = useRoute();

const userId = router.params.id;

const form = ref({
  name: "",
  introduction: "",
  urlHeaderImg: config.public.appURL + "/images/noimage.jpg",
  urlThumbnail: config.public.appURL + "/images/noimage.jpg",
});

onMounted(async () => {
  const teamInfo = teamStore.getTeams.find((team) => {
    if(team.user.profile.id == userId) {
      return team;
    }else {
      team.profiles.find(profile => {
      return  profile.user_id == userId;
      });
    }
  });
  console.log(teamInfo)
  if (teamInfo) {
    const profile = teamInfo.user.profile;
    form.value.urlHeaderImg = config.public.baseURL + "/storage/" + profile.header_img_path;
    form.value.urlThumbnail = config.public.baseURL + "/storage/" + profile.thumbnail_path;
    form.value.name = profile.name;
    form.value.introduction =profile.introduction;
  } else {
    const res = await useApiFetch(`/api/profile/${userId}`);
    const val = res.data.value;
    if (val.data != null) {
      form.value.urlHeaderImg =
        config.public.baseURL + "/storage/" + val.data.header_img_path;
      form.value.urlThumbnail =
        config.public.baseURL + "/storage/" + val.data.thumbnail_path;
      form.value.introduction = val.data.introduction;
      form.value.name = val.data.user.name;
    }
  }
});
</script>
<style lang="scss" scoped>
.v-card {
  overflow: hidden !important;
  border-radius: 10px;
}
.v-avatar {
  position: absolute !important;
  bottom: -40px;
  left: 20px;
  z-index: 1;
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
