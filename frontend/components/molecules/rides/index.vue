<template>
  <v-combobox
    v-model="teamStore.details.rides"
    :items="Levels"
    chips
    multiple
    label="タグを選択 or 入力"
  >
    <template v-slot:selection="{ attrs, item, select, selected }">
      <v-chip
        v-bind="attrs"
        :model-value="selected"
        closable
        @click="select"
        @click:close="remove(item)"
      >
        <strong>{{ item }}</strong>
        <span>(interest)</span>
      </v-chip>
    </template>
  </v-combobox>
</template>

<script setup lang="ts">
import { useTeamStore } from "~/stores/useTeamStore";
import type { Emits, Props } from "~/types";
import {Levels} from "~/constants/teams";

const teamStore = useTeamStore();

const chips = ref<Array<string>>([]);

function remove(item) {
  chips.value.splice(chips.value.indexOf(item), 1);
}

</script>
~/types/types ~/types/types
