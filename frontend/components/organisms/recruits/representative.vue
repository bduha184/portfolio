<template>
  <v-container>
      <AtomsTextsHeadLine>
        チーム代表
      </AtomsTextsHeadLine>
      <v-list>
        <v-list-item>
          <v-avatar>
            <AtomsImgs
            :path="path"
            />
          </v-avatar>
        </v-list-item>
      </v-list>
  </v-container>
</template>

<script setup lang="ts">

const props = defineProps({
  path:{
    type:String,
    default:'',
  }
})



</script>
