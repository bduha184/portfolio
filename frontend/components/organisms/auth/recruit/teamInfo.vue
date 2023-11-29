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


<script setup lang="ts">
import { Ages, Averages } from "~/constants/teams";
import { Areas } from "~/constants/areas";
import type {Emits,Props} from "~/types";

const props = defineProps<Props>();

const ageAverage = ref("");
const fromAge = ref<string>("");
const toAge = ref<string>("");
const tags = ref<string[]>([]);
const areas = ref<string[]>([]);
const detail_activities = ref<string>("");
const detail_areas = ref<string>("");
const active_datetime = ref<string>("");
const team_url = ref<string>("");

const emits = defineEmits<Emits>();

const receiveTags = (val:string) => {
  tags.value = val;
  return false;
};
const receiveTeamActivities = (val:string) => {
  detail_activities.value = val.value;
  return false;
};
const receiveTeamAreas = (val:string) => {
  detail_areas.value = val.value;
  return false;
};
const receiveteam_url = (val:string) => {
  team_url.value = val.value;
  return false;
};
const receiveactive_datetime = (val:string) => {
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
    emits("emitDetailActivities", detail_activities.value);
    emits("emitDetailAreas", detail_areas.value);
    emits("emitActiveDatetime", active_datetime.value);
    emits("emitTeamUrl", team_url.value);
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

<style scoped>
.v-text-field:deep(.v-input__details) {
  display: none;
}
</style>
