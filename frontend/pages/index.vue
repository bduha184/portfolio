<template>
  <div class="bg-white pb-2"
  >
    <OrganismsHomeHero/>
    <OrganismsHomeIntroduction/>
    <OrganismsHomeUse/>
    <AtomsBtnsBaseBtn
      width="16rem"
      color="info"
      height=auto
      class="text-h6 py-4 my-4 d-block mx-auto"
      @emitClick="handleLogin"
      >
      早速始める
    </AtomsBtnsBaseBtn>
  </div>
</template>

<script setup>
import {Url} from "~/constants/url";
import {useAuthStore} from "~/stores/useAuthStore";

const auth = useAuthStore();

onMounted(()=>{
  if(auth.isLoggedIn) {
    navigateTo(Url.MYPAGE)
  }
})

</script>
