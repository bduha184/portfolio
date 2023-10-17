<template>
<v-container>
      <AtomsTextsHeadLine> チーム情報 </AtomsTextsHeadLine>
      <v-row>
        <v-col cols="6">
          ■メンバー数
          <v-col class="text-center">
            {{ member_count }}
          </v-col>
        </v-col>
        <v-col cols="6">
          ■男女比
          <v-select
          v-model="selectedAvarage"
          :items="Averages"
          item-value="value"
          >
          </v-select>

        </v-col>
        <v-col cols="12">
          ■年齢層
          <v-row class="align-center text-center">
            <v-col cols="5">
              <v-select
              :items="Ages"
              solo
              />
            </v-col>
            <v-col cols="2">
              〜
            </v-col>
            <v-col cols="5"
            >
            <v-select
            :items="Ages"
              />
            </v-col>
          </v-row>
        </v-col>
        <v-col cols="12">
          ■チームの方向性(タグで表示)
          <MoleculesTags
          />
          <!-- <v-select
          :items="Levels"
          outlined
          /> -->
        </v-col>
        <v-col cols="12">
          ■レベル感（補足）
        <AtomsTextAreas/>
        </v-col>
      </v-row>
    </v-container>
</template>


<script setup lang="ts">
import {ref,watch} from '#imports';
import { emit } from 'process';
import {Ages,Averages,Levels} from '~/constants/teams';

const props = defineProps({
  member_count:{
    type:Number,
    default:0
  }
})

const selectedAvarage = ref('');

interface Emits {
  (e: "emitTeamInfo", value: String): void;
}
const emits = defineEmits<Emits>();

watch(()=>selectedAvarage.value,()=>{
  emits('emitTeamInfo',selectedAvarage.value);
})


</script>

<style scoped >
.v-text-field:deep(.v-input__details) {
  display: none;
}
</style>
