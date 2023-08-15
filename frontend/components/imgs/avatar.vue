<template>
    <v-avatar
    size="80"
    >
    <v-img
      :src="config.public.baseURL+'/storage/'+ thumbnail_path"
      cover
    />
    </v-avatar>
</template>

<script setup lang="ts">
import { useRuntimeConfig } from 'nuxt/app';

const config = useRuntimeConfig();

const props = defineProps({
  thumbnail_path:String,
})

</script>


<style lang="scss" scoped>
  // .v-avatar {
  //   position:absolute !important;
  //   bottom:-40px;
  //   left:20px;
  //   z-index: 10;
  // }

  .v-responsive {
  position: unset !important;
}
</style>
