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
          チーム一覧
        </h6>
        <p>
          <span class="font-weight-bold text-decoration-underline">
            {{auth.user.name}}
          </span>さんのチーム一覧ページです
        </p>
    </v-container>
    <v-container
    class="bg-white text-center"
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
      <AtomsBtnsBaseBtn
        width="10rem"
        color="info"
        :prependIcon="Icons.BACK"
        variant="outlined"
        class="my-4 text-center pr-8"
        @click="router.go(-1)"
      >
        戻る
      </AtomsBtnsBaseBtn>
    </v-container>
  </div>
</template>



<script setup lang="ts">
import { useAuthStore } from "~/stores/useAuthStore";
import {AuthTeamMenus} from "~/constants/menuItems";
import {Icons} from "~/constants/icons";

definePageMeta({
  middleware: ["auth"]
})

const router = useRouter();
const auth = useAuthStore();

</script>
