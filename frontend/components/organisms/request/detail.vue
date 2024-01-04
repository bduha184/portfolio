<template>
  <v-container>
    <OrganismsCardsProfile
      :path_header="requestItems.path_header"
      :path_thumbnail="requestItems.path_thumbnail"
    >
      <div>
        <v-card-title class="!pl-28 text-body-2">
          <AtomsTextsHeadLine>
            {{ requestItems.title }}
          </AtomsTextsHeadLine>
        </v-card-title>
        <v-card-text> {{ requestItems.title }}さんからのコメント </v-card-text>
        <v-card-text>
          {{ requestItems.comment }}
        </v-card-text>
        <v-container>
          {{ requestItems.title }}さんをチームに招待する
          <AtomsTextAreas
            placeholder="コメント"
            :body="comment"
            @emitInput="receivecomment"
          />

          <AtomsBtnsBaseBtn
            width="16rem"
            class="my-4 d-block mx-auto"
            :disabled="!checkFilledOut"
            @emitClick="handleLogin"
          >
            チームに招待する
          </AtomsBtnsBaseBtn>
        </v-container>
      </div>
    </OrganismsCardsProfile>
  </v-container>
</template>


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
