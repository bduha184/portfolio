<template>
  <v-card
  @clikc="onClick"
  height="300px"
  >
   <ImgsCardHeaderImg/>
   <v-card-title class="w-60 text-body-2 text-left ml-auto">
     <TitleHeadline :title="title"/>
   </v-card-title>
   <TextRecruitCardText :text="text"/>
  </v-card>
</template>

<script setup lang="ts">
import {ref} from 'vue';
import { StringSchema } from 'yup';

const props = defineProps({
  title:String,
  text:String
})

const onClick = () => {

}


</script>

<style lang="scss" scoped>
.v-card {
  & + & {
    margin-top: 1rem;
  }
}

</style>
