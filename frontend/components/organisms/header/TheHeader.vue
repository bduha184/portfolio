<template>
  <div>
    <v-app-bar class="overflow-visible px-2">
      <v-container
      class="d-flex align-center mx-auto"
      >
        <v-toolbar-title class="text-red font-weight-bold">
          <NuxtLink
          :to="auth.isLoggedIn ? Url.MYPAGE : Url.TOP"

          >
        <AtomsImgs
        max-width="100px"
        :path="`${config.public.appURL}/images/logo.png`"
        />
        </NuxtLink>
        </v-toolbar-title>
        <v-spacer />
        <AtomsToggle
          @emitClick="toggleMenu"
          :toggle = drawer
        />
      </v-container>
    </v-app-bar>
    <v-navigation-drawer
      v-model="drawer"
      bottom
      temporary
      location="right"
    >
      <v-list>
        <v-list-item
          v-for="(item, i) in menuItems"
          :key="i"
          :value="item"
          @click="item.func"
        >
            <AtomsIcons
            :name="item.icon"
            />
            <v-list-item-title
            class="pl-2"
            >
              <AtomsTextsHeadLine>
                {{ item.text }}
              </AtomsTextsHeadLine>
            </v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </div>
</template>


<script setup lang="ts">
import { Url } from "~/constants/url";
import { MenuItems } from "~/constants/menuItems";
import { useAuthStore } from "~/stores/useAuthStore";
import { useRuntimeConfig } from "nuxt/app";


const auth = useAuthStore();
const config = useRuntimeConfig();
const drawer = ref<boolean>(false);

const menuItems = computed(()=>{
  const menus = MenuItems.filter((item)=> {
    if(item.auth == null) return item;
    if(auth.isLoggedIn) {
      if(item.auth) return item;
    }else{
      if(!item.auth) return item;
    }
  })
  return menus;
})

const toggleMenu = () => {
  drawer.value = !drawer.value;
};
</script>


<style scoped lang="scss">
.v-app-bar.v-toolbar:not(.v-toolbar--flat) {
  box-shadow: 0 0 4px rgba(0,0,0,.2);
  }

.v-list {

  &:deep(.v-list-item__content){
    display: flex;
  align-items: center;
  }
}
</style>
