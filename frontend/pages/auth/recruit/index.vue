<template>
  <div>
    <v-container class="bg-white mb-2">
      <h6 class="text-h6">
          <AtomsIconsSquare
          :name="Icons.RECRUIT"
          color="white"
          class="bg-red p-3 rounded"
          size="50"
          />
          チーム募集ページ
        </h6>
        <p>
          <span class="font-weight-bold text-decoration-underline">
            {{auth.user.name}}
          </span>さんのチーム募集編集ページです
        </p>
    </v-container>
    <v-card>
      <OrganismsAuthRecruit/>
    </v-card>
  </div>
</template>

<script setup lang="ts">
import { Icons } from "~/constants/icons";
import { useAuthStore } from "~/stores/useAuthStore";


const auth = useAuthStore();
definePageMeta({
  middleware: ["auth"],
});

</script>
