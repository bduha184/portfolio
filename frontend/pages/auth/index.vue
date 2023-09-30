<template>
  <div>
    <h1>LoggedIn</h1>
    <v-row>
      <v-col cols="6">
        <NuxtLink :to="Url.TEAMS"> チーム </NuxtLink>
      </v-col>
      <v-col cols="6">
        <NuxtLink :to="Url.AUTHRECRUIT"> メンバー募集 </NuxtLink>
      </v-col>
      <v-col cols="6">
        <NuxtLink :to="Url.PROFILE"> プロフィール </NuxtLink>
      </v-col>
      <v-col cols="6">
        <NuxtLink :to="Url.MESSAGES"> メッセージ </NuxtLink>
      </v-col>
    </v-row>
    <v-btn @click="handleLogout"> ログアウト </v-btn>
    <v-btn @click="handleDelete"> 退会 </v-btn>
    <OrganismsModal
      @emitModalOpen="handleCheck"
      @emitModalBtnClick="handleDelete"
      setColor="orange"
      caution="※退会すると全てのデータが削除され、復元できません。退会しますか？"
      btnValue="退会する"
      btnType="delete"
    >
      退会
    </OrganismsModal>
  </div>
</template>
<script setup lang="ts">
import {ref,definePageMeta,navigateTo} from '#imports';
import {onMounted} from 'vue';
import {Url} from '../../constants/url';
import { useAuthStore } from '../../stores/useAuthStore';

definePageMeta({
  middleware: ["auth"]
})

const auth = useAuthStore();
const userId = auth.user.id;
const handleLogout = async()=> {
  await auth.logout();
}
const modalOpen = ref(false);

const handleCheck= ()=>{
}

const handleDelete = async()=> {

  await useApiFetch("/sanctum/csrf-cookie");
  await useApiFetch(`/api/user/${userId}`, {
  method: "DELETE",
}).then((res)=>{
console.log(res);
})
}
</script>
