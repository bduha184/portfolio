<template>
  <div>
    <h1 class="text-h6 font-weight-bold text-center">
      プロフィールページ
    </h1>
    <v-card>
      <OrganismsProfile/>
    </v-card>
  </div>
</template>

<script setup lang="ts">
import { definePageMeta } from "#imports";
definePageMeta({
  middleware: ["auth"],
});
</script>
