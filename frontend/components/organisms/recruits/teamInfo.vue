<template>
  <v-container>
    <AtomsTextsHeadLine> チーム情報 </AtomsTextsHeadLine>
    <v-list>
      <v-list-item>
        <v-row>
          <v-col cols="4">メンバー:</v-col>
          <v-col>{{ member_count }}人</v-col>
        </v-row>
      </v-list-item>
      <v-list-item>
        <v-row>
          <v-col cols="4">男女比:</v-col>
          <v-col>{{ average }}</v-col>
        </v-row>
      </v-list-item>
      <v-list-item>
        <v-row>
          <v-col cols="4">年齢層 :</v-col>
          <v-col> {{ from_age }}〜{{ to_age }}</v-col>
        </v-row>
      </v-list-item>
      <v-list-item>
        <v-row>
          <v-col cols="4">ライド :</v-col>
          <v-col cols="8">
            <v-chip-group>
              <v-chip v-for="(tag, i) in tags" :key="i">
                {{ tag }}
              </v-chip>
            </v-chip-group>
          </v-col>
        </v-row>
      </v-list-item>
      <v-list-item>
        <v-row>
          <v-col cols="4">ライド詳細 :</v-col>
          <v-col>{{ detail_activities }}</v-col>
        </v-row>
      </v-list-item>
      <v-list-item>
        <v-row>
          <v-col cols="4">エリア :</v-col>
          <v-col>
            <v-chip-group>
              <v-chip v-for="(area, i) in areas" :key="i">
                {{ area }}
              </v-chip>
            </v-chip-group>
          </v-col>
        </v-row>
      </v-list-item>
      <v-list-item>
        <v-row>
          <v-col cols="4">エリア詳細 :</v-col>
          <v-col>{{ detail_areas }}</v-col>
        </v-row>
      </v-list-item>
      <v-list-item>
        <v-row>
          <v-col cols="4">日時 :</v-col>
          <v-col>{{ active_datetime }}</v-col>
        </v-row>
      </v-list-item>
      <v-list-item>
        <v-row>
          <v-col cols="4">ホームページ :</v-col>
          <v-col>{{ team_url }}</v-col>
        </v-row>
      </v-list-item>
    </v-list>
  </v-container>
</template>


<script setup lang="ts">
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
</script>

<style scoped lang="scss">
.v-list {
  &:deep(.v-list-item) {
    padding-left: 0;
    padding-right: 0;
    min-height: unset;
    font-size: 0.85rem;
    border-bottom: 1px dashed #ccc;

    & .v-col {
      &:first-of-type {
        font-weight: bold;
      }
    }

    &.circle {
      border-width: 2px;
      border: 2px solid gray;
      border-radius: 50%;
      height: 100%;
      width: 85px;
      height: 85px;
      margin: 0 auto;
      text-align: center;
    }

    & + & {
      border-top: 1px solid red;
    }

    &:deep(.v-row) {
      width: 100%;
    }
  }
}

.v-col {
  padding: 3px;
}
</style>
