<script setup lang="ts">
import { Use } from "~/constants/use";
</script>

<template>
  <div class="bg-white">
    <v-container>
      <SectionTitle title="HOW TO USE" subTitle="使い方" />
      <v-row>
        <v-col class="col pl-2 " cols="12" sm="4" v-for="(item, index) in Use" :key="index">
          <v-card class="text-center">
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
  </div>
</template>

<style scoped lang="scss">
.col {
& + & {
  & .v-card{
    position: relative;
    overflow: visible;
  z-index: 0;
    &::before{
      content: "";
      display: block;
      width: 0;
      height: 0;
      border-style: solid;
      border-width: 15px 0 15px 22.5px;
      border-color: transparent transparent transparent #007bff;
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      left: -25px;
      z-index: 10;
    }
  }
}
}
</style>
