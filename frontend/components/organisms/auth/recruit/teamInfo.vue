<template>
  <v-container>
    <AtomsTextsHeadLine> チーム情報 </AtomsTextsHeadLine>
    <v-row>
      <v-col cols="6">
        ■メンバー数
        <v-col class="text-center"> {{ memberCount }}人 </v-col>
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
        <MoleculesTags @emitTags="receiveTags" :tags="tags" :items="Levels" />
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
        <v-select multiple chips v-model="areas" :items="Areas" />
      </v-col>
      <v-col cols="12">
        ■主な活動エリア（詳細）
        <AtomsTextAreas @emitInput="receiveTeamAreas" :body="detailAreas" />
      </v-col>
      <v-col cols="12">
        ■主な活動日
        <v-select multiple chips v-model="activeDate" :items="ActiveDate" />
      </v-col>
      <v-col cols="12">
        ■主な活動日時（詳細）
        <AtomsTextAreas
          @emitInput="receiveActiveDateDetail"
          :body="activeDateDetail"
        />
      </v-col>
      <v-col cols="12">
        ■ホームページ、ブログ等URL
        <AtomsTextAreas @emitInput="receiveTeamUrl" :body="teamUrl" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup lang="ts">
import { Ages, Averages, Levels, ActiveDate } from "~/constants/teams";
import { Areas } from "~/constants/areas";
import type { Emits, Props } from "~/types";

const props = defineProps<Props>();

const ageAverage = ref("");
const fromAge = ref<string>("");
const toAge = ref<string>("");
const tags = ref<string[]>([]);
const areas = ref<string[]>([]);
const detailActivities = ref<string>("");
const detailAreas = ref<string>("");
const activeDate = ref<string[]>([]);
const activeDateDetail = ref<string>("");
const teamUrl = ref<string>("");

const emits = defineEmits<Emits>();

const receiveTags = (val: string) => {
  tags.value = val;
};
const receiveTeamActivities = (val: string) => {
  detailActivities.value = val.value;
};
const receiveTeamAreas = (val: string) => {
  detailAreas.value = val.value;
};
const receiveTeamUrl = (val: string) => {
  teamUrl.value = val.value;
};

const receiveActiveDateDetail = (val: string) => {
  activeDateDetail.value = val.value;
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
    activeDate.value,
    activeDateDetail.value,
    teamUrl.value,
  ],
  () => {
    emits("emitAgeAverage", ageAverage.value);
    emits("emitFromAge", fromAge.value);
    emits("emitToAge", toAge.value);
    emits("emitTags", tags.value);
    emits("emitAreas", areas.value);
    emits("emitDetailActivities", detailActivities.value);
    emits("emitDetailAreas", detailAreas.value);
    emits("emitActiveDate", activeDate.value);
    emits("emitActiveDateDetail", activeDateDetail.value);
    emits("emitTeamUrl", teamUrl.value);
  }
);
watch(
  () => [
    props.average,
    props.fromAge,
    props.toAge,
    props.tags,
    props.areas,
    props.detailActivities,
    props.detailAreas,
    props.activeDate,
    props.activeDateDetail,
    props.teamUrl,
  ],
  () => {
    ageAverage.value = props.average;
    fromAge.value = props.fromAge;
    toAge.value = props.toAge;
    tags.value = props.tags;
    areas.value = props.areas;
    detailActivities.value = props.detailActivities;
    detailAreas.value = props.detailAreas;
    activeDate.value = props.activeDate;
    activeDateDetail.value = props.activeDateDetail;
    teamUrl.value = props.teamUrl;
  }
);
</script>

<style scoped>
.v-text-field:deep(.v-input__details) {
  display: none;
}
</style>
~/types/types ~/types/types
