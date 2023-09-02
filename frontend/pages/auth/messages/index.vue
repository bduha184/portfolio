<template>
  <v-container>
    <v-row>
      <v-col cols="6">
        <NuxtLink :to="Url.REQUESTS"
        >
          チーム参加希望
        </NuxtLink>
      </v-col>
      <v-col cols="6">
        <NuxtLink :to="Url.QUESTIONS"
        >
          質問BOX
        </NuxtLink>
      </v-col>
    </v-row>
  </v-container>
</template>
<script setup lang="ts">
import {definePageMeta} from '#imports';
import {Url} from '../../../constants/url';
import { useAuthStore } from '../../../stores/useAuthStore';

definePageMeta({
  middleware: ["auth"]
})

const auth = useAuthStore();

const handleLogout = async()=> {
  await auth.logout();

}

</script>
