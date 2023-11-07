<template>
  <div>
    <MoleculesImgsSelect
    @emitInput="receiveHeaderImg"
    :path="items.url_header_img"
    :disabled="disabled"
    size="cover"
    class="h-[100px]"
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
    </v-container>
  </div>
</template>
<script setup lang="ts">
import { ref, definePageMeta, navigateTo,onMounted,useRuntimeConfig } from "#imports";
import { Url } from "~/constants/url";
import { Icons } from "~/constants/icons";
import { useAuthStore } from "~/stores/useAuthStore";
import {AuthMenus} from '~/constants/menuItems';

definePageMeta({
  middleware: ["auth"],
});

const config = useRuntimeConfig();

const auth = useAuthStore();
const userId = auth.user.id;

const items = ref({
  header_img:'',
  url_header_img: config.public.appURL + "/images/noimage.jpg",
})

const receiveHeaderImg = (val: File) => {
  console.log(val);
  //   items.value.header_img = val.val;
  items.value.url_header_img = URL.createObjectURL(val);
  // URL.revokeObjectURL(val);
};

// onMounted(() =>{
//   teamItems.value.url_header_img =
//               config.public.baseURL +
//               "/storage/" +
//               val.teamItem.header_img_path;
// })

</script>
