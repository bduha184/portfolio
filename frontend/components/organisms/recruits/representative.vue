<template>
  <v-container>
      <AtomsTextsHeadLine>
        チーム代表
      </AtomsTextsHeadLine>
      <v-list>
        <v-list-item>
          <template v-slot:prepend>
            <NuxtLink
            :to="Url.PROFILE+'/'+props.userId"
            >
              <v-avatar size="60" class="mr-2">
                <AtomsImgs
                :path="props.pathThumbnail"
                />
              </v-avatar>
            </NuxtLink>
          </template>
          <v-list-item-title
          v-text="props.name"
          />
          <v-list-item-content
          v-text="props.introduction"
          />
        </v-list-item>
      </v-list>

  </v-container>
</template>


<script setup lang="ts">
import {Url} from "~/constants/url"

import type {Props} from "~/types";
const props = defineProps<Props>();



</script>
