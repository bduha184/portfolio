<template>
  <v-snackbar
  v-model="flashMessage"
  :color="color"
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
    default:true
  },
  color:{
    type:String,
    default:'success'
  }
})
console.log(props.isShow);

const flashMessage = ref(props.isShow);

// const isShow = computed(()=>{
//   return flashMessage.value= props.isShow;
// })

</script>

<style scoped>
.v-snackbar:deep(.v-snackbar__content){
  color: #fff !important;
  text-align: center;
  font-size: 1rem;
}
</style>
