<template>
  <v-snackbar
  :color="color"
  v-model="flashMessage"
  location="top"
  :timeout="2000"
  >
  <slot/>
  </v-snackbar>
</template>

<script setup lang="ts">
import {ref,computed} from '#imports';

const props=defineProps({
  isShow:{
    type:Boolean,
    default:false
  },
  color:{
    type:String,
    default:'success'
  }
})



const flashMessage = ref(false);

const test = computed(()=>{
  return flashMessage.value= props.isShow;
})
// console.log(flashMessage.value);
console.log(test);

</script>

<style scoped>
.v-snackbar:deep(.v-snackbar__content){
  color: #fff !important;
  text-align: center;
  font-size: 1rem;
}
</style>
