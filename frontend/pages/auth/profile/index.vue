<script setup lang="ts">
import {Icons} from "~/constants/icons";
import { useAuthStore } from "~/stores/useAuthStore";

const auth = useAuthStore();

definePageMeta({
  middleware: ["auth"],
});
</script>

<template>
  <div>
    <v-container class="bg-white mb-2">
      <h6 class="text-h6">
          <AtomsIconsSquare
          :name="Icons.ACCOUNT"
          color="white"
          class="bg-red p-3 rounded"
          size="50"
          />
          プロフィール
        </h6>
        <p>
          <span class="font-weight-bold text-decoration-underline">
            {{auth.user.name}}
          </span>さんのプロフィール編集ページです
        </p>
    </v-container>
    <v-card>
      <OrganismsAuthProfile/>
    </v-card>
  </div>
</template>
