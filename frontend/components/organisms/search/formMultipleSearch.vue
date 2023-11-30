<template>
  <div>
    <div class="align-center justify-between">
      <OrganismsSearchFormPulldown
      name="エリア"
      :items="Areas"
      />
      <OrganismsSearchFormPulldown
      name="エリア"
      :items="Areas"
      />
      <OrganismsSearchFormPulldown
      name="ライド種別"
      :items="Levels"
      />
      <v-btn
      color="red"
      variant="flat"
      height="40"
      @click="onClick"
      :prepend-icon="Icons.SEARCH"
      />
    </div>
    <!-- <v-row class="align-center justify-between d-sm-none">
      <OrganismsSearchFormPulldown name="エリア"/>
      <OrganismsSearchFormPulldown name="日時"/>
      <OrganismsSearchFormPulldown name="ライド種別"/>
    </v-row> -->
  </div>
</template>

<script setup lang="ts">
import {Areas} from "~/constants/areas";
import {Levels} from "~/constants/teams";
import {Icons} from "~/constants/icons";

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
