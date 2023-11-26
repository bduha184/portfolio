<template>
  <div class="text-center">
    <h2 class="font-weight-bold text-h4">{{props.title}}</h2>
    <p>{{props.subTitle}}</p>
  </div>
</template>


<script setup lang="ts">

const props = defineProps({
  title:String,
  subTitle:String
})

</script>

<style scoped lang="scss">
  h2{
    position:relative;
    z-index: 0;
    font-family: 'Lato', sans-serif !important;
    letter-spacing: 1px !important;
    &::after{
      content: '';
      display: block;
      width: 150px;
      height: 2px;
      background: red;
      margin: 0.2rem auto;
    }
  }

</style>
