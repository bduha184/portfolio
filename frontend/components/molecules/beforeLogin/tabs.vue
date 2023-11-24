<script setup lang="ts">
import { Icons } from "~/constants/icons";

const tab = ref<null>(null);
</script>


<template>
  <v-tabs v-model="tab" fixed-tabs class="text-center mb-4" slider-color="red">
    <MoleculesTabsBeforeLogin val="register" :icon="Icons.REGISTER">
      新規登録
    </MoleculesTabsBeforeLogin>
    <MoleculesTabsBeforeLogin val="login" :icon="Icons.LOGIN">
      ログイン
    </MoleculesTabsBeforeLogin>
  </v-tabs>
</template>



<style scoped lang="scss">
.v-tabs--density-default {
  --v-tabs-height:auto !important;
}
</style>
