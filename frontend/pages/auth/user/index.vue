<template>
  <v-container>
    <h1>LoggedIn</h1>
    <v-row>
      <v-col cols="6">
        <NuxtLink :to="Url.AUTHRECRUIT"
        >
          メンバー募集
        </NuxtLink>
      </v-col>
      <v-col cols="6">
        <NuxtLink :to="Url.PROFILE">
          プロフィール
        </NuxtLink>
      </v-col>
      <v-col cols="6">
        <NuxtLink :to="Url.REQUEST">
          チーム参加希望
        </NuxtLink>
      </v-col>
      <v-col cols="6">
        <NuxtLink :to="Url.PROFILE">
          質問BOX
        </NuxtLink>
      </v-col>
    </v-row>
    <v-btn
    @click="handleLogout"
    >
    ログアウト
    </v-btn>
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
