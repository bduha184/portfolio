<template>
  <v-btn
    nuxt
    :to="Url.SIGNIN"
    rounded
    height="40"
    class="bg-blue text-decoration-none  mx-auto"
    :class="setColor == 'orange' ? 'bg-orange text-white' : ''"
  >
  {{ btnValue }}
</v-btn>
</template>

<script setup lang="ts">
import {ref} from 'vue';
import { Url } from "@/constants/url";

const props = defineProps({
  btnValue:String,
  place:String,
  setColor:String
})

</script>

<style scoped>
.v-btn {
  line-height: 40px;
}
</style>
