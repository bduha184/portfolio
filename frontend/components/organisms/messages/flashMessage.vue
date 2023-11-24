<script setup lang="ts">
import {useFlashMessageStore} from "~/stores/useFlashMessageStore";

const flashMessage = useFlashMessageStore();

const status = ref(false);

const statusFlg = computed(()=>{
  return status.value = flashMessage.getStatus;
})

</script>

<template>
  <v-snackbar
  v-model="statusFlg"
  :color="flashMessage.getColor"
  location="top"
  >
  {{ flashMessage.getMessage }}
  </v-snackbar>
</template>

<style scoped>
.v-snackbar:deep(.v-snackbar__content){
  color: #fff !important;
  text-align: center;
  font-size: 1rem;
}
</style>
