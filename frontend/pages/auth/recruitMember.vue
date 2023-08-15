<template>
  <div>
    <h1>メンバー募集</h1>
    <form enctype="multipart/form-data">
      <label for="header_img">ヘッダー画像</label>
      <CardsRecruitCardForAdmin/>
      <input type="file" name="header_img" @change="onChange" />
      <label for="thumbnail">サムネイル</label>
      <input type="file"  name="thumbnail" @change="onChange" />
      <label for="title">タイトル</label>
      <input type="text" v-model="items.title" />
      <label for="text">本文</label>
      <input type="text" v-model="items.text" />
      <v-btn
      @click="onClick"
      >登録</v-btn>
    </form>
    <v-img
    v-if="filePath.header"
    :src="config.public.baseURL+'/storage/'+filePath.header"
    />
    <v-img
    v-if="filePath.thumbnail"
    :src="config.public.baseURL+'/storage/'+filePath.thumbnail"
    />
  </div>
</template>

<script setup lang="ts">
import { useRuntimeConfig } from 'nuxt/app';
import {definePageMeta} from '#imports';
import { useApiFetch } from '../../composables/useApiFetch';
import {ref} from 'vue';

const config  = useRuntimeConfig();
definePageMeta({
  middleware: ["auth"]
})

const items = ref({
  header_img:'',
  thumbnail:'',
  title:'',
  text:'',
});

const filePath = ref({
  header:'',
  thumbnail:''
});


const onChange = (e) => {
  const target = e.target.name;
  if(target == 'header_img'){
    items.value.header_img = e.target.files[0];
  }
  items.value.thumbnail = e.target.files[0];
}


  const onClick = async () => {

  const formData = new FormData();

  formData.append('header_img',items.value.header_img);
  formData.append('thumbnail',items.value.thumbnail);
  formData.append('title',items.value.title);
  formData.append('text',items.value.text);

  // console.log(...formData.entries());

  await useApiFetch("/sanctum/csrf-cookie");
  const res =  await useApiFetch("/api/recruit/register", {
    method: "POST",
    body: formData,
  });

  filePath.value.header = res.data.value.path_header;
  filePath.value.thumbnail = res.data.value.path_thumbnail;

};
</script>
