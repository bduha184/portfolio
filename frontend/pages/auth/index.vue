<template>
  <div>
    <MoleculesImgsSelect
    @emitInput="receiveHeaderImg"
    :path="path_header"
    :disabled="disabled"
    size="cover"
    />
    <v-container class="bg-white">
      <h6 class="text-h6">
        <AtomsIconsSquare
        :name="Icons.DASHBOARD"
        color="white"
        class="bg-red p-3 rounded"
        size="50"
        />
        ダッシュボード
      </h6>
      <p>
        <span class="font-weight-bold text-decoration-underline">{{auth.user.name}}</span>さんの管理画面です</p>
      <v-row class="text-center py-4">
        <v-col cols="6"
        v-for="(menu,i) in AuthMenus"
        :key="i"
        >
          <NuxtLink :to="menu.url">
            <AtomsIcons
                class="d-block mx-auto"
                :name="menu.icon"
                size="70"
                padding="p-2"
              />
            {{ menu.text }}
          </NuxtLink>
        </v-col>

      </v-row>
      <!-- <OrganismsModal
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
      </OrganismsModal> -->
    </v-container>
  </div>
</template>
<script setup lang="ts">
import { ref, definePageMeta, navigateTo } from "#imports";
import { onMounted } from "vue";
import { Url } from "~/constants/url";
import { Icons } from "~/constants/icons";
import { useAuthStore } from "~/stores/useAuthStore";
import {AuthMenus} from '~/constants/menuItems';

definePageMeta({
  middleware: ["auth"],
});

const auth = useAuthStore();
const userId = auth.user.id;

const handleLogout = async () => {
  await auth.logout();
};
const modalOpen = ref(false);

const handleCheck = () => {};

const handleDelete = async () => {
  await useApiFetch("/sanctum/csrf-cookie");
  await useApiFetch(`/api/user/${userId}`, {
    method: "DELETE",
  }).then((res) => {
    console.log(res);
    navigateTo(Url.SIGNUP);
  });
};
</script>
