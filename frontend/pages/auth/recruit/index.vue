<template>
  <div>
    <h1 class="text-h6 font-weight-bold text-center">
      メンバー募集の管理ページ
    </h1>
    <v-card>
      <OrganismsAuthRecruit/>
    </v-card>
  </div>
</template>

<script setup lang="ts">
import { definePageMeta } from "#imports";
definePageMeta({
  middleware: ["auth"],
});

</script>
