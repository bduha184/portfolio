<template>
  <v-container>
    <h1>LoggedIn</h1>
    <v-btn
    @click="handleLogout"
    >
    ログアウト
    </v-btn>
    {{ auth }}
  </v-container>
</template>
<script setup lang="ts">
import {definePageMeta} from '#imports';
import { useAuthStore } from '../../stores/useAuthStore';

definePageMeta({
  middleware: ["auth"]
})

const auth = useAuthStore();

const handleLogout = async()=> {
  await auth.logout();


}

</script>
