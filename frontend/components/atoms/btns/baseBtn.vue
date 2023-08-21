<template>
  <v-btn
    rounded
    height="40"
    class="bg-blue text-decoration-none  mx-auto"
    :to="to"
    :class="setColor == 'orange' ? 'bg-orange text-white':''"
    @click="submit"
  >
  <slot/>
</v-btn>
</template>

<script setup lang="ts">
import {ref} from 'vue';
import { Url } from "@/constants/url";
import { useAuthStore } from '../../../stores/useAuthStore';
import {navigateTo} from 'nuxt/app';
const auth = useAuthStore();

const props = defineProps({
    to:{
      type:String,
      default:undefined
  },
  btnValue:String,
  place:String,
  setColor:String
})
console.log(props.to)


const submit = async () => {

  if(props.place == 'guest') {
      const {error} = await auth.guestLogin();
      console.log(error);
      return navigateTo('/auth');
  }

}

</script>

<style scoped>
.v-btn {
  line-height: 40px;
}
</style>
