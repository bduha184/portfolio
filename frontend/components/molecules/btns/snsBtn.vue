<template>
  <AtomsSnsBtn>
    <AtomsImgs
    size="contain"
    :src="`${config.public.appURL}/_nuxt/assets/images/${provider}.png`"
    width="20"
    height="20"
    />
    <slot/>
  </AtomsSnsBtn>
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

<style scoped lang="scss">
.v-img{
  &:deep(.v-img__img){
  width: auto !important;
}
}
</style>
