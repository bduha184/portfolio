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

<template>
  <v-container>
    <AtomsTextsHeadLine> チーム活動内容 </AtomsTextsHeadLine>
    <v-card-text>
      {{ activities }}
    </v-card-text>
  </v-container>
</template>

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
