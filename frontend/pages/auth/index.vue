<template>
  <v-container class="bg-white">
    <h1 class="text-h5 text-center">管理画面</h1>
    <v-row class="text-center py-4">
      <v-col cols="6">
        <NuxtLink :to="Url.AUTHTEAMS"> チーム </NuxtLink>
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
      <v-col cols="6">
        <NuxtLink :to="Url.MYBICYCLE"> 愛車紹介 </NuxtLink>
      </v-col>
    </v-row>
    <OrganismsModal
      @emitModalOpen="handleCheck"
      @emitModalBtnClick="handleLogout"
      caution="ログアウトします。よろしいですか？"
      btnValue="ログアウトする"
      color="orange"
      btnType="delete"
    >
      ログアウト
    </OrganismsModal>
    <OrganismsModal
      @emitModalOpen="handleCheck"
      @emitModalBtnClick="handleDelete"
      color="error"
      caution="※退会すると全てのデータが削除され、復元できません。退会しますか？"
      btnValue="退会する"
      btnType="delete"
    >
      退会
    </OrganismsModal>
  </v-container>
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
  navigateTo(Url.SIGNUP)
})
}
</script>
