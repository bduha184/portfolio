<template>
  <div>
    認証中
  </div>
</template>

<script setup lang="ts">
import { onMounted } from "vue";
import { useAuthStore } from "../../stores/useAuthStore";

const auth = useAuthStore();

const sendToken = async (provider) => {
    await auth.providerLoginRedirect(provider);


};

onMounted(()=>{
  sendToken('google');
})

</script>
