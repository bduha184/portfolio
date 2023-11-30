<template>
  <!-- <v-select v-model="area" :items="Areas" solo /> -->
  <div>
    <select
    :name="props.name"
    id="">
      <option
      v-for="(item,index) in props.items"
      :key="index"
      :value="item"
      >
      {{ item }}
      </option>
    </select>
  </div>
</template>

<script setup lang="ts">
import type {Props} from "~/types";

const props = defineProps<Props>();

</script>

<style lang="scss" scoped>
  select {
    border: 1px solid rgb(162, 162, 162);
    border-radius: 4px;
    padding: 0.5rem;
    height: 40px;
  }

</style>
