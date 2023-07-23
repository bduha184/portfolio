<template>
    <v-container>
     <SectionTitle
     title="HOW TO USE"
     subTitle="使い方"
     />
      <v-row>
        <v-col cols="12" sm="4"
        v-for="(item,index) in Use"
      :key="index"
      >
      <v-card class="text-center">
        <div>
          STEP
          <span>
            {{ index+1 }}
          </span>
        </div>
        <p>
          {{ item.text }}
        </p>
        <v-img
          :src="`${item.img}`"
          contain
        >
        </v-img>
      </v-card>

        </v-col>
      </v-row>
    </v-container>
</template>

<script setup lang="ts">
import {ref,computed} from 'vue';
import {Use} from "@/constants/use";


</script>
