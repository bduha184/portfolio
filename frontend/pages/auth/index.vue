<template>
  <div>

    <v-container class="bg-white mb-2">
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
          <span class="font-weight-bold text-decoration-underline">
            {{auth.user.name}}
          </span>さんの管理画面です
        </p>
    </v-container>
    <v-container class="bg-white">

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
    </v-container>
  </div>
</template>


<script setup lang="ts">
import { Icons } from "~/constants/icons";
import { useAuthStore } from "~/stores/useAuthStore";
import {AuthMenus} from "~/constants/menuItems";

definePageMeta({
  middleware: ["auth"],
});

const auth = useAuthStore();

</script>
