<template>
  <v-container>
    <h1 class="text-h6 font-weight-bold text-center">
      メンバー募集の管理ページ
    </h1>
    <v-card>
    <form>
        <div
        class="relative z-0 h-[100px]"
        >
          <v-img
          :src="items.url_header_img" cover>
            <v-avatar size="80">
              <v-img :src="items.url_thumbnail" cover />
              <v-file-input
              variant="solo"
              name="thumbnail"
              @change="onChange"
              />
            </v-avatar>
          </v-img>
          <v-file-input
          variant="solo"
          name="header_img"
          @change="onChange"
          />
        </div>
        <label for="title">タイトル</label>
        <input type="text" v-model="items.title" />
        <label for="text">本文</label>
        <input type="text" v-model="items.text" />
        <v-btn @click="onClick">登録</v-btn>
      </form>
    </v-card>
  </v-container>
</template>

<script setup lang="ts">
import { useRuntimeConfig } from "nuxt/app";
import { definePageMeta } from "#imports";
import { useApiFetch } from "../../composables/useApiFetch";
import { ref } from "vue";

const config = useRuntimeConfig();
definePageMeta({
  middleware: ["auth"],
});

const items = ref({
  header_img: "",
  thumbnail: "",
  title: "",
  text: "",
  url_header_img: config.public.appURL+"/images/noimage.jpg",
  url_thumbnail: config.public.appURL+"/images/noimage.jpg",
});

console.log(config.public.appURL+"/assets/images/noimage.jpg");

const filePath = ref({
  header: "",
  thumbnail: "",
});

const onChange = (e) => {
  const target = e.target.name;
  if (target == "header_img") {
    items.value.header_img = e.target.files[0];
    items.value.url_header_img = URL.createObjectURL(items.value.header_img);
  } else {
    items.value.thumbnail = e.target.files[0];
    items.value.url_thumbnail = URL.createObjectURL(items.value.thumbnail);
  }
};

const onClick = async () => {
  const formData = new FormData();

  formData.append("header_img", items.value.header_img);
  formData.append("thumbnail", items.value.thumbnail);
  formData.append("title", items.value.title);
  formData.append("text", items.value.text);

  // console.log(...formData.entries());

  await useApiFetch("/sanctum/csrf-cookie");
  const res = await useApiFetch("/api/recruit/register", {
    method: "POST",
    body: formData,
  });

  filePath.value.header = res.data.value.path_header;
  filePath.value.thumbnail = res.data.value.path_thumbnail;
};
</script>

<style lang="scss" scoped>
.v-card {
  overflow: hidden !important;
  border-radius: 10px;
}
  .v-avatar {
    position:absolute !important;
    bottom:-40px;
    left:20px;
    z-index: 1;
  }

  .v-responsive {
  position: unset !important;
}
.v-file-input {
  opacity: 0;
  position:absolute !important;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  width: 100%;
  height: 100%;
  z-index: 10;
  background: red;
}
</style>
