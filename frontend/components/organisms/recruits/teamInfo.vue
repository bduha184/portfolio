<template>
  <v-container>
    <AtomsTextsHeadLine> チーム情報 </AtomsTextsHeadLine>
    <v-list>
      <v-list-item>
        <v-row>
          <v-col cols="4">メンバー:</v-col>
          <v-col>{{ member_count }}</v-col>
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
          <v-col cols="4">男女比 :</v-col>
          <v-col> {{ from_age }}〜{{ to_age }}</v-col>
        </v-row>
      </v-list-item>
      <v-list-item>
        <v-row>
          <v-col cols="4">活動 :</v-col>
          <v-col>{{ detailActivities }}</v-col>
        </v-row>
      </v-list-item>
      <v-list-item>
        <v-row>
          <v-col cols="4">エリア :</v-col>
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
      <v-list-item>
        <v-row>
          <v-col>
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
          <v-col>
            <v-chip-group>
              <v-chip v-for="(area, i) in areas" :key="i">
                {{ area }}
              </v-chip>
            </v-chip-group>
          </v-col>
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
    min-height: unset;
    font-size: 0.85rem;

    & .v-col {
      &:first-of-type {
        font-weight: bold;
      }
    }

     &.circle {
      border-width:2px;
      border: 2px solid gray;
      border-radius:50%;
      height: 100%;
      width: 85px;
    height: 85px;
    margin: 0 auto;
    text-align: center;
    }

    & + & {
      border-top: 1px solid;
    }

    &:deep(.v-row) {
      width: 100%;
    }
  }

}

.v-chip {
  min-width:fit-content;
  &-group{
    flex-wrap: nowrap;
  }
}

.v-col {
  padding:3px;
}
</style>
