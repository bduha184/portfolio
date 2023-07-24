<template>
    <v-container>
      <SectionTitle title="HOW TO USE" subTitle="使い方" />
      <v-row>
        <v-col class="d-flex align-center" cols="12" sm="4" v-for="(item, index) in Use" :key="index">
          <div v-show="index > 0" class="arrow"></div>
          <v-card class="text-center w-100">
            <div>
              STEP
              <span>
                {{ index + 1 }}
              </span>
            </div>
            <p>
              {{ item.text }}
            </p>
            <v-img :src="`${item.img}`" contain> </v-img>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
</template>

<script setup lang="ts">
import { ref, computed } from "vue";
import { Use } from "@/constants/use";
</script>

<style scoped lang="scss">
.arrow {
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 25px 0 25px 43.3px;
  border-color: transparent transparent transparent #007bff;
}
</style>
