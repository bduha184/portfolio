<template>
  <div class="p-4 bg-white">
      <MoleculesBeforeLoginTabs v-model="tab"/>
      <v-window v-model="tab">
        <v-window-item value="register">
          <OrganismsBeforeLoginSignUp/>
        </v-window-item>
        <v-window-item value="login">
          <OrganismsBeforeLoginSignIn/>
        </v-window-item>
      </v-window>
  </div>
</template>
<script setup lang="ts">
import { ref } from "vue";

const tab = ref(null);
</script>
