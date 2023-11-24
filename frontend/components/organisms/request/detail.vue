<script setup lang="ts">

const router = useRoute();
const config = useRuntimeConfig();

const requestItems = ref({
  path_header: "",
  path_thumbnail: "",
  title: "",
  comment: "",
});

const comment = ref("");

const receivecomment = (val) => {
  comment.value = val.value;
};

const checkFilledOut = computed(() => {
  if (comment.value) {
    return true;
  } else {
    return false;
  }
});

onMounted(async () => {
  const userId = router.params.id;
  if (userId) {
    const res = await useApiFetch(`/api/message/${userId}`);
    const val = res.data.value;
    console.log(val);
    requestItems.value.path_header =
      config.public.baseURL + "/storage/" + val.data.header_img_path;
    requestItems.value.path_thumbnail =
      config.public.baseURL + "/storage/" + val.data.thumbnail_path;
    requestItems.value.title = val.data.title;
    requestItems.value.comment = val.data.comment;
  }
});
</script>

<template>
  <v-container>
    <AtomsTextsHeadLine> チーム活動内容 </AtomsTextsHeadLine>
    <v-card-text>
      {{ activities }}
    </v-card-text>
  </v-container>
</template>
