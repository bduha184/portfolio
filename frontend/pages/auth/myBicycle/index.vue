<template>
  <div>
    <h1 class="text-h6 font-weight-bold text-center">
      愛車紹介
    </h1>
    <v-card>
      <OrganismsProfile/>
    </v-card>
  </div>
</template>

<script setup lang="ts">
definePageMeta({
  middleware: ["auth"],
});
</script>
