<template>
  <v-card>
   <ImgsCardHeaderImg
   :header_img_path="header_img_path"
   :thumbnail_path="thumbnail_path"
   />
   <v-card-title class="w-60 text-body-2 text-left ml-auto">
     <TitleHeadline :title="title"/>
   </v-card-title>
   <TextRecruitCardText :text="text"/>
   <GalleryLightGallery/>
   <TeamActivity/>
   <div>
   <ButtonCommon btnValue="このチームに参加する"/>
   <ButtonCommon btnValue="このチームに質問する" setColor="orange"/>
   </div>
   <RecruitProfile
   :prof_thumbnail_path="prof_thumbnail_path"
   />
  </v-card>
</template>

<script setup lang="ts">
import { navigateTo } from 'nuxt/app';
import {ref} from 'vue';
import { StringSchema } from 'yup';

const props = defineProps({
  header_img_path:String,
  thumbnail_path:String,
  prof_thumbnail_path:String,
  title:String,
  text:String
})



</script>

<style lang="scss" scoped>
.v-card {
  & + & {
    margin-top: 1rem;
  }
}
.v-card {
  overflow:visible !important;
}
  .v-avatar {
    position:absolute !important;
    bottom:-40px;
    left:20px;
    z-index: 10;
  }

  .v-responsive {
  position: unset !important;
}

</style>
