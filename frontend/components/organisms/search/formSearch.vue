<template>
  <div class="d-flex align-center">
    <AtomsInput
          placeholder="検索キーワード"
          type="text"
          @emitInput="receiveKeywords"
        />
       <v-btn
       color="red"
       variant="flat"
       height="40"
       @click="onClick"
       >
         検索
       </v-btn>
      </div>
</template>

<script setup lang="ts">
import {ref} from '#imports';
import {useTeamStore} from "~/stores/useTeamStore";

const teams = useTeamStore();

const keywords = ref([]);

const receiveKeywords = (val) => {
  keywords.value.length = 0;

  const words = val.value.split(' ');

  words.forEach(word => {
    keywords.value.push(word);
  });
}

const onClick = ()=>{
  teams.fetchTeams(keywords.value);
}
</script>

<style lang="scss" scoped>
  input[type="text"] {
    border: 1px solid rgb(162, 162, 162);
    border-radius: 4px;
    padding: 0.5rem;
    height: 40px;
    max-width: 300px;
    width: 100%;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
  }
  .v-btn {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
  }
</style>
