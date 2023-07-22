<script setup lang="ts">
import { computed, reactive } from "vue";
import { Url } from "@/constants/url";
import { MenuItems } from "@/constants/menuItems";
import { useRouter } from "nuxt/app";
const router = useRouter();
import {
  mdiAccount,
  mdiHome,
  mdiAccountCircle,
  mdiBike,
  mdiInformation,
  mdiMapMarker,
  mdiBicycle,
} from "@mdi/js";

const state = reactive({
  name: "",
  drawer: false,
});

const toggleMenu = () => {
  state.drawer = !state.drawer;
};
const hoverToggleMenu = () => {
  state.isHovering = !state.isHovering;
};

const menuLinks = computed(() => {
  return [
    {
      text: "ホーム",
      icon: mdiHome,
      func: () => router.push(Url.TOP),
    },
    {
      text: "マイページ",
      icon: mdiAccountCircle,
      func: () => router.push(Url.MEMBER),
    },
    {
      text: "サイクリング募集",
      icon: mdiBike,
      func: () => router.push(Url.RECRUIT),
    },
    {
      text: "サイクリング情報",
      icon: mdiInformation,
      func: () => router.push(Url.INFO),
    },
    {
      text: "みんなの愛車",
      icon: mdiBicycle,
      func: () => router.push(Url.INTRODUCTION),
    },
    {
      text: "ルート検索",
      icon: mdiMapMarker,
      func: () => router.push(Url.SEARCH),
    },
    {
      text: "新規登録",
      icon: mdiAccount,
      func: () => router.push(Url.SIGNUP),
    },
    {
      text: "ログイン",
      icon: mdiAccount,
      func: () => router.push(Url.LOGIN),
    },
  ];
});
</script>
ˇ

<template>
  <div>
    <v-navigation-drawer
      v-model="state.drawer"
      bottom
      temporary
      location="right"
      class="pt-15"
    >
      <v-list density="compact" nav>
        <v-list-item
          v-for="(item, i) in menuLinks"
          :key="i"
          :value="item"
          active-color="primary"
          @click="item.func"
        >
          <template v-slot:prepend>
            <v-icon
              :icon="item.icon"
              class="relative before:absolute before:w-10 before:h-10 before:border-2 before:border-gray-400 before:rounded-full"
            />
          </template>
          <v-list-item-title
            class="pl-2 ml-2 relative before:absolute before:left-0 before:top-0 before:h-full before:w-[2px] before:bg-orange-600 z-100"
            >{{ item.text }}</v-list-item-title
          >
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar class="overflow-visible px-2" prominent
      ><v-container class="d-flex align-center">
        <!-- <logo /> -->
        <v-toolbar-title class="text-red font-weight-bold">
          <NuxtLink :to="Url.TOP"> Cycle Community </NuxtLink>
        </v-toolbar-title>
        <v-spacer />

        <Btn
        btnValue="ログイン・新規登録"
        place="LOGIN"
        />
        <v-app-bar-nav-icon
        variant="outlined"
        height="40"
        width="40"
        class="visible ml-4"
        @click.stop="toggleMenu"
        />
      </v-container>
    </v-app-bar>
  </div>
</template>
