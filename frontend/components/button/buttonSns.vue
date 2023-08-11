<template>
  <v-btn
    variant="outlined"
    rounded="0"
    class="d-block mx-auto border-2 border-indigo-500 w-[250px]"
    @click="submit(provider)"
  >
    <v-img
      contain
      :src="`../../assets/images/${img}.png`"
      class="mr-auto"
      width="20"
      height="20"
    />
    {{ btnValue }}
  </v-btn>
</template>


<script setup lang="ts">
import { Url } from '../../constants/url';
import { useAuthStore } from '../../stores/useAuthStore';

const auth = useAuthStore();

const props = defineProps({
  btnValue:String,
  img:String,
  provider:String,
})

const submit = async(provider) => {

    const loginRes = await auth.providerLogin(provider);
        window.location.href = loginRes.data.value.redirect_url;

}

</script>
