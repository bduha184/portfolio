<template>
  <div class="p-4">
    <v-container class="bg-white">
      <v-tabs
        v-model="tab"
        fixed-tabs
        class="text-center mb-4"
        slider-color="red"
      >
        <v-tab value="register">
          <Icon :name="Icons.REGISTER" />
          新規登録
        </v-tab>
        <v-tab value="login">
          <Icon :name="Icons.LOGIN" />
          ログイン
        </v-tab>
      </v-tabs>
      <v-window v-model="tab">
        <v-window-item value="register">
          <BeforeLoginSignUp/>
        </v-window-item>
        <v-window-item value="login">
          <BeforeLoginSignIn/>
        </v-window-item>
      </v-window>
    </v-container>
  </div>
</template>
<script setup lang="ts">
import { Icons } from "@/constants/icons";

import { ref } from "vue";

const tab = ref(null);
</script>
