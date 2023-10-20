<template>
  <v-container>
    <AtomsTextsHeadLine> チーム情報 </AtomsTextsHeadLine>
    <v-row>
      <v-col cols="6">
        ■メンバー数
        <v-col class="text-center">
          {{ member_count }}
        </v-col>
      </v-col>
      <v-col cols="6">
        ■男女比
        <v-select v-model="ageAverage" :items="Averages"> </v-select>
      </v-col>
      <v-col cols="12">
        ■年齢層
        <v-row class="align-center text-center">
          <v-col cols="5">
            <v-select v-model="fromAge" :items="Ages" solo />
          </v-col>
          <v-col cols="2"> 〜 </v-col>
          <v-col cols="5">
            <v-select v-model="toAge" :items="Ages" />
          </v-col>
        </v-row>
      </v-col>
      <v-col cols="12">
        ■チームの方向性(５個まで)
        <MoleculesTags
        @emitTags="receiveTags"
        :tags="tags"
        />
      </v-col>
      <v-col cols="12">
        ■レベル感（補足）
        <AtomsTextAreas />
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup lang="ts">
import { ref, watch } from "#imports";
import { emit } from "process";
import { Ages, Averages, Levels } from "~/constants/teams";

const props = defineProps({
  member_count: {
    type: Number,
    default: 0,
  },
  average: {
    type: String,
    default: "",
  },
  from_age: {
    type: String,
    default: "",
  },
  to_age: {
    type: String,
    default: "",
  },
  tags: {
    type: Array,
    default: [],
  },
});

const ageAverage = ref("");
const fromAge = ref("");
const toAge = ref("");
const tags = ref([]);


interface Emits {
  (e: "emitAgeAverage", value: String): void;
  (e: "emitFromAge", value: String): void;
  (e: "emitToAge", value: String): void;
  (e: "emitTags", value: String): void;
}
const emits = defineEmits<Emits>();

const receiveTags = (val) => {
  tags.value = val;
};

watch(
  () => [ageAverage.value, fromAge.value, toAge.value, tags.value],
  () => {
    emits("emitAgeAverage", ageAverage.value);
    emits("emitFromAge", fromAge.value);
    emits("emitToAge", toAge.value);
    emits("emitTags", tags.value);
  }
  );
  watch(
    () => [props.average, props.from_age, props.to_age, props.tags],
    () => {
      ageAverage.value = props.average;
      fromAge.value = props.from_age;
      toAge.value = props.to_age;
      tags.value = props.tags;
    }
);
</script>

<style scoped>
.v-text-field:deep(.v-input__details) {
  display: none;
}
</style>
