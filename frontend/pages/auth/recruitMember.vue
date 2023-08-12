<template>
  <div>
    <h1>メンバー募集</h1>
    <form>
      <label for="header_img">ヘッダー画像</label>
      <input type="file"  @change="onChangeHeader" />
      <label for="thumbnail">サムネイル</label>
      <input type="file"  @change="onChangeThumb" />
      <label for="title">タイトル</label>
      <input type="text" v-model="items.title" />
      <label for="text">本文</label>
      <input type="text" v-model="items.text" />
      <v-btn
      @click="onClick"
      >登録</v-btn>
    </form>
  </div>
</template>

<script setup lang="ts">
import {definePageMeta} from '#imports';
import { useApiFetch } from '../../composables/useApiFetch';
import {ref} from 'vue';


definePageMeta({
  middleware: ["auth"]
})

const items = ref({
  header_img:'',
  thumbnail:'',
  title:'',
  text:'',
});

const onChangeHeader = (e) => {
  items.value.header_img = e.target.files[0].name;
}
const onChangeThumb = (e) => {
  items.value.thumbnail = e.target.files[0].name;
}


const onClick = async () => {
  const formData = new FormData();

  formData.append('header_img',items.value.header_img);
  formData.append('thumbnail',items.value.thumbnail);
  formData.append('title',items.value.title);
  formData.append('text',items.value.text);

  console.log(...formData.entries());
  // await useApiFetch("/sanctum/csrf-cookie");

  // const res =  await useApiFetch("/api/recruit/register", {
  //   method: "POST",
  //   body: {
  //     formData,
  //   },
  //   headers: {
  //         'content-type': 'multipart/form-data'
  //         }
  // });

  // console.log(res);
};
</script>
