<template>
  <div>
    <OrganismsImgsCardProfile
      :pathHeader="form.urlHeaderImg"
      :pathThumbnail="form.urlThumbnail"
    />
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
    return team.user.profile.id == userId;
  });

  const profileInfo = teamStore.getTeamDetail.profiles.find(profile=>{
    return profile.id == router.params.id;
  })
  if (teamInfo) {
    const profile = teamInfo.user.profile;
    form.value.urlHeaderImg = config.public.baseURL + "/storage/" + profile.header_img_path;
    form.value.urlThumbnail = config.public.baseURL + "/storage/" + profile.thumbnail_path;
    form.value.name = profile.name;
    form.value.introduction =profile.introduction;
  }else{
    if(profileInfo){
      form.value.urlHeaderImg = config.public.baseURL + "/storage/" + profileInfo.header_img_path;
      form.value.urlThumbnail = config.public.baseURL + "/storage/" + profileInfo.thumbnail_path;
      form.value.name = profileInfo.user.name;
      form.value.introduction =profileInfo.introduction;

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
