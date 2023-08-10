<template>
  <div>
    認証中
  </div>
</template>

<script setup lang="ts">
import { onMounted } from "vue";
import { useAuthStore } from "../../stores/useAuthStore";
import {useRoute} from 'vue-router';
import { navigateTo } from "nuxt/app";
const auth = useAuthStore();
const route = useRoute();

console.log(route);

const sendToken = async (provider) => {
    const redirectRes = await auth.providerLoginRedirect(provider,route.query);
console.log(redirectRes);

if(!redirectRes.status) return navigateTo('/beforeLogin');

return navigateTo('/auth');

};

onMounted(()=>{
  sendToken('google');
})

</script>
