<script setup lang="ts">

const props = defineProps({
  user_id:{
    type:Number,
    default:''
  },
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

<template>
  <v-container>
    <AtomsTextsHeadLine> チーム活動内容 </AtomsTextsHeadLine>
    <v-card-text>
      {{ activities }}
    </v-card-text>
  </v-container>
</template>
