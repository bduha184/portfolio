<template>
  <v-container>
    <h1>LoggedIn</h1>
    <v-btn
    @click="handleLogout"
    >
    ログアウト
    </v-btn>
    <NuxtLink :to="{
      path:Url.AUTHRECRUIT,
      query:{
        user:userId
      }
    }"
    @click.prevent="getRecruitItem"
    >
      メンバー募集
    </NuxtLink>
    <NuxtLink :to="{
      path:Url.PROFILE,
      query:{
        user:user
      }
    }">
      プロフィール
    </NuxtLink>
  </v-container>
</template>
<script setup lang="ts">
import {definePageMeta} from '#imports';
import {Url} from '../../constants/url';
import { useAuthStore } from '../../stores/useAuthStore';
import { onMounted } from 'vue';
import { useRecruitStore } from '../../stores/useRecruitStore';
import {useRoute} from 'vue-router';

definePageMeta({
  middleware: ["auth"]
})

const recruit = useRecruitStore();
const userId = recruit.id;

const getRecruitItem = () => {
  recruit.fetchRecruitItem();
}

const auth = useAuthStore();

const handleLogout = async()=> {
  await auth.logout();

}

</script>
