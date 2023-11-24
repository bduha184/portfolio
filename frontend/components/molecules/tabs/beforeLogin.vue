<script setup lang="ts">
import type { Props} from "~/types";
const props = defineProps<Props>();

</script>

<template>
  <v-tab
  :value="val"
  >
    <AtomsIcons
    class="d-block mx-auto"
    :name="icon"
    size="50"
    padding="p-2"
    />
      <slot />
  </v-tab>
</template>


<style scoped lang="scss">
.v-btn {

  padding: 0.5rem !important;

  &:deep(.v-btn__content){
    display: block;
  }
}
</style>
