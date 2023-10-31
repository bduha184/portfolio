<template>
  <v-container>
      <AtomsTextsHeadLine>
        チーム代表
      </AtomsTextsHeadLine>
      <v-list>
        <v-list-item>
          <template v-slot:prepend>
            <NuxtLink
            :to="Url.PROFILE+'/'+user_id"
            >
              <v-avatar size="60" class="mr-2">
                <AtomsImgs
                :path="path_thumbnail"
                />
              </v-avatar>
            </NuxtLink>
          </template>
          <v-list-item-title
          v-text="introduction"
          />
        </v-list-item>
      </v-list>
  </v-container>
</template>

<script setup lang="ts">
import { navigateTo } from "nuxt/app"
import {Url} from "~/constants/url"


const props = defineProps({
  user_id:{
    type:Number,
    default:''
  },
  path_thumbnail:{
    type:String,
    default:'',
  },
  introduction:{
    type:String,
    default:'',
  }
})



</script>
