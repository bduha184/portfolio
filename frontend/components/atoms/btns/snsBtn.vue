<template>
  <v-btn
    variant="outlined"
    rounded="0"
    @click="onClick"
  >
    <v-img
      contain
      :src="`${config.public.appURL}/_nuxt/assets/images/${provider}.png`"
      width="20"
      height="20"
    />
    <slot/>
  </v-btn>
</template>


<script setup lang="ts">
import { useAuthStore } from '../../../stores/useAuthStore';
import {useRuntimeConfig} from 'nuxt/app';

const auth = useAuthStore();
const config = useRuntimeConfig();
const props = defineProps({
  provider:{
    type:String,
    default:undefined
  }
})

const emits = defineEmits(['click']);

const onClick = () => {
  emits('click');
}

const submit = async(provider) => {

    const loginRes = await auth.providerLogin(provider);
        window.location.href = loginRes.data.value.redirect_url;

}

</script>
