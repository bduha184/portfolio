<template>
  <v-btn
  variant="text"
  :icon="Icons.NAVI"
    height="40"
    class="text-decoration-none rotate-90"
    :to="to"
    @click="onClick"
  />
</template>

<script setup lang="ts">
import {Icons} from '../../../constants/icons';

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
