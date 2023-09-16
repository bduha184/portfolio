<script setup lang="ts">
import { reactive } from "vue";
import { Url } from "@/constants/url";
import { MenuItems } from "@/constants/menuItems";

const state = reactive({
  name: "",
  drawer: false,
});

const toggleMenu = () => {
  state.drawer = !state.drawer;
};
</script>

<template>
  <div>
    <v-app-bar class="overflow-visible px-2" prominent
      ><v-container class="d-flex align-center">
        <v-toolbar-title class="text-red font-weight-bold">
          <NuxtLink :to="Url.TOP"> Cycle Community </NuxtLink>
        </v-toolbar-title>
        <v-spacer />

        <ButtonCommon
          btnValue="ログイン・新規登録"
          place="SIGNIN"
          class="invisible sm:visible"
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
    <v-navigation-drawer
      v-model="state.drawer"
      bottom
      temporary
      location="right"
      class="pt-15"
    >
      <v-list>
        <v-list-item
          v-for="(item, i) in MenuItems"
          :key="i"
          :value="item"
          @click="item.func"
          :prependIcon="item.icon"
        >
          <v-list-item-avatar>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title>{{ item.text }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </div>
</template>

<style scoped lang="scss">
.v-app-bar.v-toolbar:not(.v-toolbar--flat) {
  box-shadow: none;
}

// header {
//   z-index: 0 !important;
// }
</style>
