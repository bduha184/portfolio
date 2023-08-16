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
        user:user
      }
    }">
      メンバー募集
    </NuxtLink>
    <NuxtLink :to="Url.PROFILE">
      プロフィール
    </NuxtLink>
  </v-container>
</template>
<script setup lang="ts">
import {definePageMeta} from '#imports';
import {Url} from '../../constants/url';
import { useAuthStore } from '../../stores/useAuthStore';
import { onMounted } from 'vue';

definePageMeta({
  middleware: ["auth"]
})

console.log(Url.AUTHRECRUIT);

const auth = useAuthStore();

const fetchUser = async () => {

  const res = await auth.fetchUser();
  console.log(res);
}

onMounted(()=>{
fetchUser();
})


const handleLogout = async()=> {
  await auth.logout();


}

</script>
