<template>
  <div class="p-4">
    <v-container class="bg-white">
      <FormKeywordsSearch/>
      <FormMultipleSearch/>
      <DisplayTeamCount/>
      <TabsRecruitTab/>
      <CardsRecruitCard
      v-for="(item,index ) in items"
      :key="index"
      :title="item.title"
      :text="item.text"
      />
    </v-container>
  </div>
</template>
<script setup lang="ts">

import {ref} from 'vue';


const item = ref({
  title:'',
  text:''
})

const items  = [
  {
    title:'タイトル１',
    text:'テキスト１'
  },
  {
    title:'タイトル2',
    text:'テキスト2'
  },
  {
    title:'タイトル３',
    text:'テキスト３'
  },
  {
    title:'タイトル４',
    text:'テキスト４'
  }
]

</script>

<style lang="scss" scoped>
.v-container {
padding-right: 0.5rem !important;
padding-left:0.5rem !important;
}
</style>
