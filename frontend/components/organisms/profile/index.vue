<template>
  <div>
    <OrganismsImgsCardProfile
      @emitInput="receiveProfileImage"
      :path_header="form.url_header_img"
      :path_thumbnail="form.url_thumbnail"
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

const config = useRuntimeConfig();
const router = useRoute();

const form = ref({
  path_header: "",
  path_thumbnail: "",
  name: '',
  header_img: "",
  thumbnail: "",
  introduction: "",
  url_header_img: config.public.appURL + "/images/noimage.jpg",
  url_thumbnail: config.public.appURL + "/images/noimage.jpg",
});


onMounted(async () => {
  const userId = router.params.id;
  if (userId) {
    const res = await useApiFetch(`/api/profile/${userId}`);
    const val = res.data.value;
    console.log(val);
    if(val.data != null){
      form.value.url_header_img =
        config.public.baseURL + "/storage/" + val.data.header_img_path;
      form.value.url_thumbnail =
        config.public.baseURL + "/storage/" + val.data.thumbnail_path;
      form.value.introduction = val.data.introduction;
      form.value.name = val.data.name;
      form.value.item_id = val.data.id;
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
