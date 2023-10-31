<script setup lang="ts">
import { ref,computed } from "#imports";
import { Url } from "@/constants/url";
import { MenuItems } from "@/constants/menuItems";
import { useAuthStore } from "../stores/useAuthStore";


const auth = useAuthStore();
const drawer = ref(false);

const menuItems = computed(()=>{
  if(auth.isLoggedIn) {
    console.log('isloggedin');
    return MenuItems
  }else {
    console.log('beforelogin');
    const menus = MenuItems.map((item)=> {
      if(!item.auth) return item;
    })
    return menus;
  }

})

console.log(menuItems);

const toggleMenu = () => {
  drawer.value = !drawer.value;
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
        {{ item.auth }}
            <AtomsIcons
            :name="item.icon"
            />
          <v-list-item-content>
            <v-list-item-title
            class="pl-2"
            >
              <AtomsTextsHeadLine>
                {{ item.text }}
              </AtomsTextsHeadLine>
            </v-list-item-title>
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

.v-list {

  &:deep(.v-list-item__content){
    display: flex;
  align-items: center;
  }
}

// header {
//   z-index: 0 !important;
// }
</style>
