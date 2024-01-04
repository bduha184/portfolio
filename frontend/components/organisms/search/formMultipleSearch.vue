<template>
  <div>
    <div class="pt-5 d-flex align-center justify-between">
      <OrganismsSearchFormPulldown
      v-for="(item,i) in items"
      :key="i"
      :label="labels[i]"
      :items=item
      @emitInput="(val)=>(refs[i] = val)"
      />

      <v-btn
        height="40"
        width="40"
        color="red"
        variant="flat"
        :icon="Icons.SEARCH"
        @click="onClick"
      />
    </div>
  </div>
</template>

<script setup lang="ts">
import { Areas } from "~/constants/areas";
import { Levels, Days } from "~/constants/teams";
import { Icons } from "~/constants/icons";
import { useTeamStore } from "~/stores/useTeamStore";

const teamStore = useTeamStore();

const items = [Areas,Days,Levels];
const labels = ['エリア','日時','ライド種別'];
const refs = ref([]);

const onClick = () => {
  teamStore.setPageInitialize();
  teamStore.setKeywords(refs.value);
  teamStore.getTeams();
};

</script>

<style lang="scss" scoped>
.v-btn {
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
  border-bottom-left-radius: 0;
  border-top-left-radius: 0;
}
.v-input {
  &:deep(.v-field__input) {
    padding: 0.5rem !important;
  }
}
</style>
