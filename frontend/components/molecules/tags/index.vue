<template>
  <v-combobox
    v-model="chips"
    :items="items"
    chips
    label="タグを選択 or 入力"
    multiple
  >
    <template v-slot:selection="{ attrs, item, select, selected }">
      <v-chip
        v-bind="attrs"
        :model-value="selected"
        closable
        @click="select"
        @click:close="remove(item)"
      >
        <strong>{{ item }}</strong
        >
        <span>(interest)</span>
      </v-chip>
    </template>
  </v-combobox>
</template>

<script setup>
import { ref } from "#imports";
import { Levels } from "~/constants/teams";
const items = Levels;

const chips = ref([
  "例）ゆるぽた",
]);

function remove(item) {
  chips.value.splice(chips.value.indexOf(item), 1);
}
</script>
