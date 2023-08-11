<template>
    <v-container>
     <SectionTitle
     title="Features"
     subTitle="主な機能"
     />
     <div
     class="text-center py-4"
     >CycleCommunityでは、①メンバー募集 ②愛車紹介 ③ルート検索 ④サイクリング情報の4つの機能を集約し</div>
      <v-row v-for="(item,index) in Features"
      :key="index"
      :class="index % 2 != 0 ? 'flex-row-reverse' : ''"
      >
        <v-col cols="12" sm="6">
          <v-row>
            <v-col>
              <div class="d-flex">
                <Icon :name="item.icon"/>
                <p class="pl-4 ml-4 relative before:absolute before:left-0 before:top-0 before:h-full before:w-[2px] before:bg-orange-600 z-100">
                  {{ item.title }}
                </p>
              </div>
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              {{ item.text }}
            </v-col>
          </v-row>
        </v-col>
        <v-col  cols="12" sm="6">
          <v-img
            :src="`${item.img}`"
            contain
          >
          </v-img>
        </v-col>
      </v-row>
    </v-container>
</template>

<script setup lang="ts">
import {ref,computed} from 'vue';
import {Features} from "@/constants/features";

</script>
