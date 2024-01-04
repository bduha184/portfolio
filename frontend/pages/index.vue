<template>
  <div class="pb-2"
  >
    <OrganismsHomeHero/>
    <OrganismsHomeIntroduction/>
    <OrganismsHomeUse/>
    <AtomsBtnsBaseBtn
      width="16rem"
      color="info"
      height=auto
      class="text-h6 py-4 my-4 d-block mx-auto"
      @emitClick="receiveClick"
      >
      無料で始める
    </AtomsBtnsBaseBtn>

  </div>
</template>

<script setup lang="ts">
import {Url} from "~/constants/url";
import {useAuthStore} from "~/stores/useAuthStore";

const auth = useAuthStore();

const receiveClick = () => {
  navigateTo(Url.SIGNUP);
}

onMounted(()=>{
  if(auth.isLoggedIn) {
    navigateTo(Url.MYPAGE)
  }
})

</script>
