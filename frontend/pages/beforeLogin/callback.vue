<template>
  <div>認証中</div>
</template>

<script setup lang="ts">
import { useAuthStore } from "~/stores/useAuthStore";
import { useFlashMessageStore } from "~/stores/useFlashMessageStore";
import {Url} from "~/constants/url";
import { Message} from "~/constants/flashMessage";

const auth = useAuthStore();
const route = useRoute();
const flashMessage = useFlashMessageStore();

const sendToken = async (query:Object) => {
  const redirectRes = await auth.providerLoginRedirect(query);

  console.log(redirectRes);

  if (redirectRes.error.value != null) {
    flashMessage.setMessage(Message.LOGINERROR,'error',6000);
    return navigateTo(Url.SIGNUP);
  }

  if (redirectRes.data.value.user == false) {
    return navigateTo({

      path:Url.SIGNUP + '/snsRegister',
      query: {
        email:redirectRes.data.value.email,
        provider:redirectRes.data.value.provider,
        token:redirectRes.data.value.token
      }
    })

  }
  flashMessage.setMessage(Message.LOGIN);
  return navigateTo("/auth");
};

onMounted(() => {

  sendToken(route.query);
});
</script>
