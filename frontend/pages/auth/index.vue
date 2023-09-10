<template>
  <v-container>
    <h1>LoggedIn</h1>
    <v-row>
      <v-col cols="6">
        <NuxtLink :to="Url.TEAMS"
        >
          チーム
        </NuxtLink>
      </v-col>
      <v-col cols="6">
        <NuxtLink :to="{
          name:'auth-recruit',
          query:{
            id:auth.user.id
          }
        }">
          メンバー募集
        </NuxtLink>
      </v-col>
      <v-col cols="6">
        <NuxtLink :to="Url.PROFILE">
          プロフィール
        </NuxtLink>
      </v-col>
      <v-col cols="6">
        <NuxtLink :to="Url.MESSAGES">
          メッセージ
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
import {Url} from '../../constants/url';
import { useAuthStore } from '../../stores/useAuthStore';

definePageMeta({
  middleware: ["auth"]
})

const auth = useAuthStore();

const handleLogout = async()=> {
  await auth.logout();

}

</script>
