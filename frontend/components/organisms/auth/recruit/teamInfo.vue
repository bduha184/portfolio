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
        <v-select v-model="ageAverage" :items="Averages" />
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
        ■チームの活動
        <MoleculesTags @emitTags="receiveTags" :tags="tags" />
      </v-col>
      <v-col cols="12">
        ■チームの活動(補足)
        <AtomsTextAreas
          @emitInput="receiveTeamActivities"
          :body="detailActivities"
        />
      </v-col>
      <v-col cols="12">
        ■主な活動エリア
        <v-select v-model="areas" multiple :items="Areas" />
      </v-col>
      <v-col cols="12">
        ■主な活動エリア（詳細）
        <AtomsTextAreas @emitInput="receiveTeamAreas" :body="detailAreas" />
      </v-col>
      <v-col cols="12">
        ■主な活動日時
        <AtomsTextAreas
          @emitInput="receiveActiveDateTime"
          :body="activeDateTime"
        />
      </v-col>
      <v-col cols="12">
        ■ホームページ、ブログ等URL
        <AtomsTextAreas @emitInput="receiveTeamUrl" :body="teamUrl" />
      </v-col>
    </v-row>
    {{ teamUrl }}
    {{ activeDateTime }}
  </v-container>
</template>

<script setup lang="ts">
import { ref, watch } from "#imports";
import { emit } from "process";
import { Ages, Averages, Levels } from "~/constants/teams";
import { Areas } from "~/constants/areas";

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
  areas: {
    type: Array,
    default: [],
  },
  detailActivities: {
    type: String,
    default: "",
  },
  detailAreas: {
    type: String,
    default: "",
  },
  activeDateTime: {
    type: String,
    default: "",
  },
  teamUrl: {
    type: String,
    default: "",
  },
});

const ageAverage = ref("");
const fromAge = ref("");
const toAge = ref("");
const tags = ref([]);
const areas = ref([]);
const detailActivities = ref("");
const detailAreas = ref("");
const activeDateTime = ref("");
const teamUrl = ref("");

interface Emits {
  (e: "emitAgeAverage", value: String): void;
  (e: "emitFromAge", value: String): void;
  (e: "emitToAge", value: String): void;
  (e: "emitTags", value: String): void;
  (e: "emitAreas", value: String): void;
  (e: "emitDetailActivities", value: String): void;
  (e: "emitDetailAreas", value: String): void;
  (e: "emitTeamUrl", value: String): void;
  (e: "emitActiveDatetime", value: String): void;
}
const emits = defineEmits<Emits>();

const receiveTags = (val) => {
  tags.value = val;
};
const receiveTeamActivities = (val) => {
  return (detailActivities.value = val.value);
};
const receiveTeamAreas = (val) => {
  return (detailAreas.value = val.value);
};
const receiveTeamUrl = (val) => {
  return (teamUrl.value = val.value);
};
const receiveActiveDateTime = (val) => {
  return (activeDateTime.value = val.value);
};

watch(
  () => [
    ageAverage.value,
    fromAge.value,
    toAge.value,
    tags.value,
    areas.value,
    detailActivities.value,
    detailAreas.value,
    teamUrl.value,
    activeDateTime.value,
  ],
  () => {
    emits("emitAgeAverage", ageAverage.value);
    emits("emitFromAge", fromAge.value);
    emits("emitToAge", toAge.value);
    emits("emitTags", tags.value);
    emits("emitAreas", areas.value);
    emits("emitDetailActivities", detailActivities.value);
    emits("emitDetailAreas", detailAreas.value);
    emits("emitTeamUrl", teamUrl.value);
    emits("emitActiveDatetime", activeDateTime.value);
  }
);
watch(
  () => [
    props.average,
    props.from_age,
    props.to_age,
    props.tags,
    props.areas,
    props.detailActivities,
    props.detailAreas,
    props.activeDateTime,
    props.teamUrl,
  ],
  () => {
    ageAverage.value = props.average;
    fromAge.value = props.from_age;
    toAge.value = props.to_age;
    tags.value = props.tags;
    areas.value = props.areas;
    detailActivities.value = props.detailActivities;
    detailAreas.value = props.detailAreas;
    activeDateTime.value = props.activeDateTime;
    teamUrl.value = props.teamUrl;
  }
);
</script>

<style scoped>
.v-text-field:deep(.v-input__details) {
  display: none;
}
</style>
