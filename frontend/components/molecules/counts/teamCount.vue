<template>
  <div>
    <AtomsTextsHeadLine> 募集チーム： </AtomsTextsHeadLine>
    <span class="text-red pr-1">{{ val }}</span
    >件
  </div>
</template>

<script setup lang="ts">
import type { Props } from "~/types/props";
defineProps<Props>();
</script>
