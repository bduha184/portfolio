<template>
  <div class="bg-white pb-2">
    <OrganismsHomeHero/>
    <OrganismsHomeIntroduction/>
    <OrganismsHomeUse/>
    <AtomsBtnsBaseBtn
      width="16rem"
      color="info"
      class="my-4 d-block mx-auto"
      @emitClick="handleLogin"
      >
      早速始める
    </AtomsBtnsBaseBtn>
  </div>
</template>
