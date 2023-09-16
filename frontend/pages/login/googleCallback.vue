<template>
  <div>認証中</div>
</template>

<script setup lang="ts">
import { onMounted } from "vue";
import { useAuthStore } from "../../stores/useAuthStore";
import { useRoute } from "vue-router";
import { navigateTo } from "nuxt/app";
const auth = useAuthStore();
const route = useRoute();

const sendToken = async (provider, query) => {
  const redirectRes = await auth.providerLoginRedirect(provider, query);


  if (redirectRes.error.value != null) {
    return navigateTo("/beforelogin");
  }

  if (redirectRes.data.value.user == false) {
    return navigateTo({

    path:'/beforelogin/snsRegister',
      query: {
        email:redirectRes.data.value.email,
        provider:redirectRes.data.value.provider,
        token:redirectRes.data.value.token
      }

    })

  }
  return navigateTo("/auth");
};

onMounted(() => {
  sendToken("google", route.query);
});
</script>
