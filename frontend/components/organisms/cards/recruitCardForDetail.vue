<template>
   <v-card  height="300px">
    <div class="relative z-0 h-[100px]">
      <AtomsImgsCardHeaderImg
        :disabled="false"
        :path="header_img_path"
      >
        <AtomsImgsThumbnail
          :disabled="false"
          :path="thumbnail_path"
        />
      </AtomsImgsCardHeaderImg>
    </div>
   <v-card-title class="w-60 text-body-2 text-left ml-auto">
     <AtomsDecorationHeadline>
      {{ title }}
     </AtomsDecorationHeadline>
   </v-card-title>
   <v-card-text>
      {{ text }}
    </v-card-text>
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
import { useRuntimeConfig } from 'nuxt/app';

const props = defineProps({
  header_img_path:String,
  thumbnail_path:String,
  prof_thumbnail_path:String,
  title:String,
  text:String
})

console.log(props.header_img_path);

const config = useRuntimeConfig();



</script>

<style lang="scss" scoped>
.v-card {
  & + & {
    margin-top: 1rem;
  }
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
