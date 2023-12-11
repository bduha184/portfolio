<template>
  <div>
    <div class="pt-5 d-flex align-center justify-between">
      <OrganismsSearchFormPulldown
        label="エリア"
        :items="Areas"
        @emitInput="receiveInput"
      />
      <!-- <OrganismsSearchFormPulldown
      label="日時"
      :items="days"
      @emitInput="receiveInput"
      /> -->
      <OrganismsSearchFormPulldown
        label="ライド種別"
        :items="Levels"
        @emitInput="receiveInput"
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
import { Levels, days } from "~/constants/teams";
import { Icons } from "~/constants/icons";
import { useTeamStore } from "~/stores/useTeamStore";

const teamStore = useTeamStore();

const keywords = ref<string[]>([]);

const receiveInput = (val: string) => {
  keywords.value.push(val);
};

const onClick = () => {
  teamStore.setPageInitialize();
  teamStore.fetchTeams(keywords.value, true);
  keywords.value.length = 0;
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
