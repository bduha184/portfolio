<template>
  <v-card >
    <div class="relative z-0 h-[100px]">
      <AtomsImgsCardHeaderImg
        :disabled="false"
        :path="path_header"
      >
        <AtomsImgsThumbnail
          :disabled="false"
          :path="path_thumbnail"
        />
      </AtomsImgsCardHeaderImg>
    </div>
    <slot/>
  </v-card>
</template>

<script setup lang="ts">
import { useRuntimeConfig } from 'nuxt/app';

const config =useRuntimeConfig();

const props=defineProps({
  path_header:{
    type:String,
    default:'',
  },
  path_thumbnail:{
    type:String,
    default:'',
  }
})

</script>
