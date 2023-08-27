<template>
  <v-container>
    <v-card  height="300px">
    <div class="relative z-0 h-[100px]">
      <AtomsImgsCardHeaderImg
        :disabled="false"
        :path="recruit.getRecruitHeaderUrl"
      >
        <AtomsImgsThumbnail
          :disabled="false"
          :path="recruit.getRecruitThumbnailUrl"
        />
      </AtomsImgsCardHeaderImg>
    </div>
    <v-form>

    </v-form>
  </v-card>
</v-container>
</template>
