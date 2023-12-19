
<template>
  <v-container>
    <AtomsTextsHeadLine> チーム活動内容 </AtomsTextsHeadLine>
    <v-card-text>
      {{ props.activities }}
    </v-card-text>
  </v-container>
</template>


<script setup lang="ts">
import type { Props } from "~/types/props";
const props = defineProps<Props>();

</script>
