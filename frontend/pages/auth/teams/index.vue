<template>
  <v-container
  class="bg-white"
  >
    <v-row class="text-center py-4">
      <v-col cols="6"
      v-for="(menu,i) in AuthTeamMenus"
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
</template>
<script setup lang="ts">
import {definePageMeta} from '#imports';
import {Url} from '~/constants/url';
import { useAuthStore } from '~/stores/useAuthStore';
import {AuthTeamMenus} from '~/constants/menuItems';

definePageMeta({
  middleware: ["auth"]
})

const auth = useAuthStore();

const handleLogout = async()=> {
  await auth.logout();

}

</script>
