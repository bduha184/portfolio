<template>
  <div class="d-flex align-center">
      <input type="text" placeholder="検索キーワード">
       <v-btn
       color="red"
       variant="flat"
       height="40"
       @click="onClick"
       >
         検索
       </v-btn>
      </div>
</template>

<script setup lang="ts">
import {ref} from 'vue';

const load = ref({
  loaded:false,
  loading:false
})

const onClick = ()=>{
  load.value.loading = true;

  setTimeout(() => {
      load.value.loading = false;
      load.value.loaded = true;
  }, 2000);
}
</script>

<style lang="scss" scoped>
  input[type="text"] {
    border: 1px solid rgb(162, 162, 162);
    border-radius: 4px;
    padding: 0.5rem;
    height: 40px;
    max-width: 300px;
    width: 100%;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
  }
  .v-btn {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
  }
</style>
