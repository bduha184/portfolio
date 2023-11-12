<script setup lang="ts">
import {useRouter} from "#imports";
import {Icons} from '~/constants/icons';
const router = useRouter();


</script>

<template>
  <div class="container">
    <div class="stack">
      <h1 class="text-red text-h1">404</h1>
      <p class="error-message text-red">お探しのページは見つかりませんでした。</p>
      <AtomsBtnsBaseBtn
        width="10rem"
        color="info"
        :prependIcon="Icons.BACK"
        variant="outlined"
        class="my-4 text-center pr-8"
        @click="router.push('/')"
      >
        戻る
      </AtomsBtnsBaseBtn>
    </div>
  </div>
</template>

<style scoped>
.container {
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}
</style>
