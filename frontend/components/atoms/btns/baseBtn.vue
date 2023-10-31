<template>
  <v-btn
    rounded
    :height=height
    :to="to"
    :color="color"
    @click="onClick"
    :variant="variant"
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
  },
  variant:{
    type:String,
    default:'elevated'
  },
  height:{
    type:Number,
    default:40
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
