<script setup lang="ts">
import type { Props} from "~/types";

const props = withDefaults(defineProps<Props>(),{
  size:35,
})

</script>

<template>
  <v-icon
    :icon="name"
    :size="size"
  />
</template>
