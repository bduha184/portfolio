<template>
  <v-container fluid>
    <v-checkbox v-model="checkbox" color="red">
      <template v-slot:label>
        <div class="text-center">
          <v-tooltip bottom>
            <template v-slot:activator="{ on }">
              <NuxtLink
              class="text-red"
              :to="Url.TOP"
              v-on="on"
              >利用規約</NuxtLink>
            </template>
            利用規約を読む
          </v-tooltip>
          <span>・</span>
          <v-tooltip bottom>
            <template v-slot:activator="{ on }">
              <NuxtLink
              class="text-red"
              :to="Url.TOP"
              v-on="on"
              >プライバシーポリシー</NuxtLink>
            </template>
            プライバシーポリシーを読む
          </v-tooltip>
          を確認し、同意しました<span class=" text-red text-caption">※</span>
        </div>
      </template>
    </v-checkbox>
  </v-container>
</template>

<script setup lang="ts">
  import {ref} from 'vue';
  import {Url} from '@/constants/url';

  const checkbox = ref(false);

</script>
