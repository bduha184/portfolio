<template>
  <div>
    <div class="pt-5 d-flex align-center justify-between">
      <OrganismsSearchFormPulldown
        label="エリア"
        :items="Areas"
        @emitInput="(val)=> {area=val}"
      />
      <OrganismsSearchFormPulldown
      label="日時"
      :items="Days"
      @emitInput="(val)=> {day=val}"
      />
      <OrganismsSearchFormPulldown
        label="ライド種別"
        :items="Levels"
        @emitInput="(val)=> {ride=val}"
      />
      <v-btn
        height="40"
        width="40"
        color="red"
        variant="flat"
        @click="onClick"
        :icon="Icons.SEARCH"
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

const area = ref<string>();
const day = ref<string>();
const ride = ref<string>();

const onClick = () => {
  teamStore.setPageInitialize();
  teamStore.fetchTeams([area.value,day.value,ride.value], true);
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
