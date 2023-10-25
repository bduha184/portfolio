<template>
  <v-container>
      <AtomsTextsHeadLine>
        チーム代表
      </AtomsTextsHeadLine>
      <v-list>
        <v-list-item>
          <template v-slot:prepend>
            <v-avatar size="60">
              <AtomsImgs
              :path="path_thumbnail"
              />
            </v-avatar>
          </template>
          <v-list-item-title
          v-text="introduction"
          />
        </v-list-item>
      </v-list>
  </v-container>
</template>

<script setup lang="ts">

const props = defineProps({
  path_thumbnail:{
    type:String,
    default:'',
  },
  introduction:{
    type:String,
    default:'',
  }
})



</script>
