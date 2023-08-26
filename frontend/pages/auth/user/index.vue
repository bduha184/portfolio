<template>
  <v-container>
    <h1>LoggedIn</h1>
    <v-btn
    @click="handleLogout"
    >
    ログアウト
    </v-btn>
    <NuxtLink :to="Url.AUTHRECRUIT"
    >
      メンバー募集
    </NuxtLink>
    <NuxtLink :to="Url.PROFILE">
      プロフィール
    </NuxtLink>
    {{ $route }}
  </v-container>
</template>
<script setup lang="ts">
import {definePageMeta} from '#imports';
import {Url} from '../../../constants/url';
import { useAuthStore } from '../../../stores/useAuthStore';
import { useRecruitStore } from '../../../stores/useRecruitStore';

definePageMeta({
  middleware: ["auth"]
})

const recruit = useRecruitStore();
const auth = useAuthStore();

const handleLogout = async()=> {
  await auth.logout();

}

</script>
