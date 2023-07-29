<template>
  <v-container>
    <h1>LoggedIn</h1>
  </v-container>
</template>
<script setup lang="ts">
definePageMeta({
  middleware: ["auth"]
})
</script>
