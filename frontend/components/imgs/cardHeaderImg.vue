<template>
  <v-card height="100px" class="relative z-0">
    <v-img
      :src="config.public.baseURL+'/storage/'+ header_img_path"
      cover
    >
    <v-avatar
    size="80"
    >
    <v-img
      :src="config.public.baseURL+'/storage/'+ thumbnail_path"
      cover
    >
      </v-img>
    </v-avatar>

    </v-img>
  </v-card>
</template>

<script setup lang="ts">
import { useRuntimeConfig } from 'nuxt/app';

const config = useRuntimeConfig();

const props = defineProps({
  header_img_path:String,
  thumbnail_path:String,
})

</script>


<style lang="scss" scoped>
.v-card {
  overflow:visible !important;
}
  .v-avatar {
    position:absolute !important;
    bottom:-40px;
    left:20px;
    z-index: 10;
  }

  .v-responsive {
  position: unset !important;
}
</style>
