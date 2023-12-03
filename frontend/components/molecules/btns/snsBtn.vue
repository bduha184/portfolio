<template>
  <AtomsSnsBtn>
    <template v-slot:prepend>
      <AtomsImgs
        size="contain"
        :src="`${config.public.appURL}/_nuxt/assets/images/${provider}.png`"
        width="20"
        height="20"
      />
    </template>
    <slot />
  </AtomsSnsBtn>
</template>
<script setup lang="ts">
import type { Props } from "~/types";

const config = useRuntimeConfig();
const props = defineProps<Props>();
</script>

<style scoped lang="scss">
.v-img {
  &:deep(.v-img__img) {
    width: auto !important;
  }
}
</style>
~/types/types ~/types/types
