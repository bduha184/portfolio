<template>
  <v-card
  @clikc="onClick"
  height="300px"
  >
   <ImgsCardHeaderImg
   :header_img_path="header_img_path"
   :thumbnail_path="thumbnail_path"
   />
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
  header_img_path:String,
  thumbnail_path:String,
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
