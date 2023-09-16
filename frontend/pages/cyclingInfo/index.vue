<template>
  <v-container>
    <v-row>
      <v-col cols="6">
        <NuxtLink :to="Url.REQUESTS"
        >
        投稿一覧
        </NuxtLink>
      </v-col>
      <v-col cols="6">
        <NuxtLink :to="Url.QUESTIONS"
        >
          外部リンク
        </NuxtLink>
      </v-col>
    </v-row>
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
