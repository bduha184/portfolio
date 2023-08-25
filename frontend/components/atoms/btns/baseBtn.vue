<template>
  <v-btn
    rounded
    height="40"
    class="bg-blue text-decoration-none"
    :to="to"
    :class="setColor == 'orange' ? 'bg-orange text-white':''"
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
  setColor:{
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
