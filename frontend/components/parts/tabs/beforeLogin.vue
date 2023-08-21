<template>
    <v-tab value="register">
          <Icon :name="icon" />
          <slot/>
    </v-tab>
</template>

<script setup>
const props = defineProps({
  icon:{
    type:String,
    default:''
  }
})

</script>
