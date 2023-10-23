<template>
  <v-container>
    <AtomsTextsHeadLine> チーム情報 </AtomsTextsHeadLine>
    <v-list>
      <v-list-item>
        <v-row>
          <v-col cols="4">メンバー :</v-col>
          <v-col>{{ member_count }}</v-col>
        </v-row>
      </v-list-item>
      <v-list-item>
        <v-row>
          <v-col  cols="4">男女比 :</v-col>
          <v-col>{{ from_age }}〜{{ to_age }}</v-col>
        </v-row>
      </v-list-item>
      <v-list-item>
        <v-row>
          <v-col  cols="4">年齢層 :</v-col>
          <v-col>{{ average }}</v-col>
        </v-row>
      </v-list-item>
      <v-list-item>
        <v-row>
          <v-col cols="4">活動 :</v-col>
          <v-col>
            <v-chip v-for="(tag, i) in tags" :key="i">
              {{ tag }}
            </v-chip>
          </v-col>
        </v-row>
      </v-list-item>
      <v-list-item>
        <v-row>
          <v-col cols="4">活動（詳細） :</v-col>
          <v-col>{{ detailActivities }}</v-col>
        </v-row>
      </v-list-item>
      <v-list-item>
        <v-row>
          <v-col cols="4">エリア :</v-col>
          <v-col>{{ areas }}</v-col>
        </v-row>
      </v-list-item>
      <v-list-item>
        <v-row>
          <v-col cols="4">エリア（詳細） :</v-col>
          <v-col>{{ detailAreas }}</v-col>
        </v-row>
      </v-list-item>
      <v-list-item>
        <v-row>
          <v-col cols="4">日時 :</v-col>
          <v-col>{{ activeDateTime }}</v-col>
        </v-row>
      </v-list-item>
      <v-list-item>
        <v-row>
          <v-col cols="4">ホームページ :</v-col>
          <v-col>{{ teamUrl }}</v-col>
        </v-row>
      </v-list-item>
    </v-list>
  </v-container>
</template>

<script setup lant="ts">
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
</script>

<style scoped lang="scss">
.v-list {
  &:deep(.v-list-item) {
    padding-left: 0;
    padding-right: 0;

    & + & {
      border-top: 1px solid;
    }

    &:deep(.v-row){
      width: 100%;
    }
  }
}
</style>
