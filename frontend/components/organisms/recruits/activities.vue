<script setup lant="ts">

const props = defineProps({
  activities:{
    type:String,
    default:''
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
