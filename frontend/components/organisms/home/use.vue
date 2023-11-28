<script setup lang="ts">
import { Use } from "~/constants/use";

</script>

<template>
  <v-container>
    <OrganismsHomeSectionTitle title="HOW TO USE" subTitle="使い方" />
    <v-list class="d-flex mx-auto">
      <v-list-item
        class="text-center"
        min-width="220px"
        v-for="(item, index) in Use"
        :key="index"
      >
        <v-card>
          <v-card-title>
            STEP
            <span>
              {{ index + 1 }}
            </span>
          </v-card-title>
          <v-card-text
          class="px-0"
          >
            {{ item.text }}
          </v-card-text>
          <v-img contain :src="`${item.img}`" />
        </v-card>
      </v-list-item>
    </v-list>
  </v-container>
</template>

<style scoped lang="scss">
.v-list {
  &-item {
    width: 33%;
    position: relative;
    overflow: visible;
    z-index: 0;
    &:not(:last-of-type) {
      margin-right: 0.5rem;
      &::before {
          content: "";
          display: block;
          width: 0;
          height: 0;
          border-style: solid;
          border-width: 15px 0 15px 22.5px;
          border-color: transparent transparent transparent #2196F3;
          position: absolute;
          top: 55%;
          right:-15px;
          z-index: 10;
        }

    }
  }
}

</style>
