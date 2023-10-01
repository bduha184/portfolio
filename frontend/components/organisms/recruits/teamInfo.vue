<template>
  <v-container>
    <AtomsTextsHeadLine> チーム構成 </AtomsTextsHeadLine>
    <v-card-text>
      {{ activities }}
    </v-card-text>
  </v-container>
</template>

<script setup lant="ts">


const props = defineProps({
  activities:{
    type:String,
    default:''
  }
})


</script>
