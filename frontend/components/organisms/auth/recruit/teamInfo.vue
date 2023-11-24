<script setup lang="ts">
import { ref, watch } from "#imports";
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
  detail_activities: {
    type: String,
    default: "",
  },
  detail_areas: {
    type: String,
    default: "",
  },
  active_datetime: {
    type: String,
    default: "",
  },
  team_url: {
    type: String,
    default: "",
  },
});

const ageAverage = ref("");
const fromAge = ref("");
const toAge = ref("");
const tags = ref([]);
const areas = ref([]);
const detail_activities = ref("");
const detail_areas = ref("");
const active_datetime = ref("");
const team_url = ref("");

interface Emits {
  (e: "emitAgeAverage", value: String): void;
  (e: "emitFromAge", value: String): void;
  (e: "emitToAge", value: String): void;
  (e: "emitTags", value: String): void;
  (e: "emitAreas", value: String): void;
  (e: "emitdetail_activities", value: String): void;
  (e: "emitdetail_areas", value: String): void;
  (e: "emitactive_datetime", value: String): void;
  (e: "emitteam_url", value: String): void;
}
const emits = defineEmits<Emits>();

const receiveTags = (val) => {
  tags.value = val;
  return false;
};
const receiveTeamActivities = (val) => {
  detail_activities.value = val.value;
  return false;
};
const receiveTeamAreas = (val) => {
  detail_areas.value = val.value;
  return false;
};
const receiveteam_url = (val) => {
  team_url.value = val.value;
  return false;
};
const receiveactive_datetime = (val) => {
  active_datetime.value = val.value;
  return false;
};

watch(
  () => [
    ageAverage.value,
    fromAge.value,
    toAge.value,
    tags.value,
    areas.value,
    detail_activities.value,
    detail_areas.value,
    active_datetime.value,
    team_url.value,
  ],
  () => {
    emits("emitAgeAverage", ageAverage.value);
    emits("emitFromAge", fromAge.value);
    emits("emitToAge", toAge.value);
    emits("emitTags", tags.value);
    emits("emitAreas", areas.value);
    emits("emitdetail_activities", detail_activities.value);
    emits("emitdetail_areas", detail_areas.value);
    emits("emitactive_datetime", active_datetime.value);
    emits("emitteam_url", team_url.value);
  }
);
watch(
  () => [
    props.average,
    props.from_age,
    props.to_age,
    props.tags,
    props.areas,
    props.detail_activities,
    props.detail_areas,
    props.active_datetime,
    props.team_url,
  ],
  () => {
    ageAverage.value = props.average;
    fromAge.value = props.from_age;
    toAge.value = props.to_age;
    tags.value = props.tags;
    areas.value = props.areas;
    detail_activities.value = props.detail_activities;
    detail_areas.value = props.detail_areas;
    active_datetime.value = props.active_datetime;
    team_url.value = props.team_url;
  }
);
</script>


<template>
  <v-container>
    <AtomsTextsHeadLine> チーム情報 </AtomsTextsHeadLine>
    <v-row>
      <v-col cols="6">
        ■メンバー数
        <v-col class="text-center">
          {{ member_count }}人
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
          :body="detail_activities"
        />
      </v-col>
      <v-col cols="12">
        ■主な活動エリア
        <v-select v-model="areas" multiple :items="Areas" />
      </v-col>
      <v-col cols="12">
        ■主な活動エリア（詳細）
        <AtomsTextAreas @emitInput="receiveTeamAreas" :body="detail_areas" />
      </v-col>
      <v-col cols="12">
        ■主な活動日時
        <AtomsTextAreas
          @emitInput="receiveactive_datetime"
          :body="active_datetime"
        />
      </v-col>
      <v-col cols="12">
        ■ホームページ、ブログ等URL
        <AtomsTextAreas @emitInput="receiveteam_url" :body="team_url" />
      </v-col>
    </v-row>
  </v-container>
</template>

<style scoped>
.v-text-field:deep(.v-input__details) {
  display: none;
}
</style>
