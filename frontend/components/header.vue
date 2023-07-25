<script setup lang="ts">
import {  reactive } from "vue";
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
    <v-navigation-drawer
      v-model="state.drawer"
      bottom
      temporary
      location="right"
      class="pt-15"
    >
      <v-list density="compact" nav>
        <v-list-item
          v-for="(item, i) in MenuItems"
          :key="i"
          :value="item"
          active-color="primary"
          @click="item.func"
        >
          <Icon :name="item.icon"/>
          <v-list-item-title
          align="center"
            class="d-inline-block pl-2 ml-2 relative before:absolute before:left-0 before:top-0 before:h-full before:w-[2px] before:bg-orange-600 z-100"
            >
            {{ item.text }}
            </v-list-item-title
          >
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar class="overflow-visible px-2" prominent
      ><v-container class="d-flex align-center">
        <v-toolbar-title class="text-red font-weight-bold">
          <NuxtLink :to="Url.TOP"> Cycle Community </NuxtLink>
        </v-toolbar-title>
        <v-spacer />

        <Btn
        btnValue="ログイン・新規登録"
        place="LOGIN"
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
  </div>
</template>


<style scoped lang="scss">
.v-app-bar.v-toolbar:not(.v-toolbar--flat) {
  box-shadow: none;
}
</style>
