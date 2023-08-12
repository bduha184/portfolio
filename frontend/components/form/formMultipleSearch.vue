<template>
  <v-container>
    <v-row class="align-center justify-between">
      <FormPulldown name="エリア"/>
      <span>×</span>
      <FormPulldown name="日時"/>
      <span>×</span>
      <FormPulldown name="ライド種別"/>
      <v-btn
      color="red"
      variant="flat"
      height="40"
      @click="onClick"
      :prepend-icon="Icons.SEARCH"
      />
    </v-row>
  </v-container>
</template>

<script setup lang="ts">
import {Icons} from '../../constants/icons'
import {ref} from 'vue';

const load = ref({
loaded:false,
loading:false
})


</script>

<style lang="scss" scoped>
.v-btn__prepend {
    margin-right: 0;
}
// .v-container {
//   padding-left: 5px;
//   padding-right: 5px;
// }
</style>
