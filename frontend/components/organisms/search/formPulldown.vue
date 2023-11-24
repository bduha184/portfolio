<script setup lang="ts">
import {Areas} from "~/constants/areas";

const area = ref();

</script>

<template>
  <v-select v-model="area" :items="Areas" solo />
</template>


<style lang="scss" scoped>
  select {
    border: 1px solid rgb(162, 162, 162);
    border-radius: 4px;
    padding: 0.5rem;
    height: 40px;
  }

</style>
