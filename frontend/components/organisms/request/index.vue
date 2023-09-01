<template>
  <div>
    参加希望
    <v-card class="mx-auto">
      <v-list>
        <v-list-item
        v-for="(message, index) in messages"
          prepend-avatar="https://cdn.vuetifyjs.com/images/john.png"
          rounded="shaped"
          :title="message.name"
          :key="index"
          :subtitle="message.comments"
          @click="onClick(message.user_id)"
        />
        {{ messages }}
      </v-list>
    </v-card>
  </div>
</template>

<script setup lang="ts">
import { onMounted,ref } from "vue";
import { navigateTo } from "nuxt/app";
import {useAuthStore} from "../../../stores/useAuthStore";

const auth = useAuthStore();

const messages = ref([]);

const onClick = (id) =>{
  return navigateTo(`/auth/user/messages/requests/${id}`)
}

onMounted(async () => {
  messages.value.length = 0;
  const authId = auth.user.id;
  const res = await useApiFetch(`/api/message/${authId}`);
  // console.log(res);
  messages.value.push(...res.data.value.messages);
});


</script>

<style lang=scss scoped>
.v-list-item {
  & + & {
    margin-top: 0.5rem;
  }
}
</style>
