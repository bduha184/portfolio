<template>
    <select>
      <option selected value="">{{ name }}</option>
    </select>
</template>

<script setup lang="ts">
import {usePrefecturesStore} from '../../stores/usePrefecturesStore';
const props = defineProps({
  name:String
})

const prefectures = usePrefecturesStore();

console.log(prefectures);
</script>

<style lang="scss" scoped>
  select {
    border: 1px solid rgb(162, 162, 162);
    border-radius: 4px;
    padding: 0.5rem;
    height: 40px;
  }

</style>
