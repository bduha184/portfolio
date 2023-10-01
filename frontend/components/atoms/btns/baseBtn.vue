<template>
  <v-btn
    rounded
    height="40"
    :to="to"
    :color="color"
    @click="onClick"
  >
  <slot/>
</v-btn>
</template>

<script setup lang="ts">
const props = defineProps({
    to:{
      type:String,
      default:''
  },
  color:{
    type:String,
    default:''
  }
})

const emits = defineEmits(['emitClick'])

const onClick = (e) => {
emits('emitClick',e.target);
}


</script>

<style scoped>
.v-btn {
  line-height: 40px;
}
</style>
