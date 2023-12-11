<template>
  <v-container>
    <AtomsTextsHeadLine> チーム情報 </AtomsTextsHeadLine>
    <v-row>
      <v-col cols="6">
        ■メンバー数
        <v-col class="text-center">{{teamStore.details.memberCount}}人 </v-col>
      </v-col>
      <v-col cols="6">
        ■男女比
        <v-select v-model="teamStore.details.average" :items="Averages" />
      </v-col>
      <v-col cols="12">
        ■年齢層
        <v-row class="align-center text-center">
          <v-col cols="5">
            <v-select v-model="teamStore.details.fromAge" :items="Ages" solo />
          </v-col>
          <v-col cols="2"> 〜 </v-col>
          <v-col cols="5">
            <v-select v-model="teamStore.details.toAge" :items="Ages" />
          </v-col>
        </v-row>
      </v-col>
      <v-col cols="12">
        ■チームの活動
        <MoleculesRides />
      </v-col>
      <v-col cols="12">
        ■チームの活動(補足)
        <AtomsTextAreas
          @emitInput="receiveDetailActivities"
          :body="teamStore.details.detailActivities"
        />
      </v-col>
      <v-col cols="12">
        ■主な活動エリア
        <v-select
          multiple
          chips
          v-model="teamStore.details.areas"
          :items="Areas"
        />
      </v-col>
      <v-col cols="12">
        ■主な活動エリア（詳細）
        <AtomsTextAreas
          @emitInput="receiveDetailAreas"
          :body="teamStore.details.detailAreas"
        />
      </v-col>
      <v-col cols="12">
        ■主な活動日
        <v-select
          multiple
          chips
          v-model="teamStore.details.days"
          :items="days"
        />
      </v-col>
      <v-col cols="12">
        ■主な活動日時（詳細）
        <AtomsTextAreas
          @emitInput="receiveActiveDateDetail"
          :body="teamStore.details.detailDays"
        />
      </v-col>
      <v-col cols="12">
        ■ホームページ、ブログ等URL
        <AtomsTextAreas
          @emitInput="receiveTeamUrl"
          :body="teamStore.details.teamUrl"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup lang="ts">
import { Ages, Averages, days } from "~/constants/teams";
import { Areas } from "~/constants/areas";
import { useTeamStore } from "~/stores/useTeamStore";
const teamStore = useTeamStore();

const receiveDetailActivities = (val) => {
  teamStore.details.detailActivities = val.value;
};
const receiveDetailAreas = (val) => {
  teamStore.details.detailAreas = val.value;
};
const receiveActiveDateDetail = (val) => {
  teamStore.details.detailDays = val.value;
};
const receiveTeamUrl = (val) => {
  teamStore.details.teamUrl = val.value;
};
</script>

<style scoped>
.v-text-field:deep(.v-input__details) {
  display: none;
}
</style>
~/types/types ~/types/types
