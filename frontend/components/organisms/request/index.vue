<template>
  <div>
    参加希望
    <v-card class="mx-auto">
      <v-list>
        <v-list-item
        v-for="(message, index) in messages"
          :prepend-avatar="config.public.baseURL+'/storage/'+message.thumbnail_path"
          rounded="shaped"
          :title="message.name"
          :key="index"
          :subtitle="message.comments"
          @click="onClick(message.sender_id)"
        />
      </v-list>
    </v-card>
  </div>
</template>

<script setup lang="ts">
import { useRuntimeConfig } from "nuxt/app";
import { onMounted,ref } from "vue";
import {Url} from '../../../constants/url';
import { navigateTo } from "nuxt/app";
import {useAuthStore} from "../../../stores/useAuthStore";

const auth = useAuthStore();
const config = useRuntimeConfig();
const messages = ref([]);

const onClick = (id) =>{
  return navigateTo(`${Url.REQUESTS}/${id}`)
}

onMounted(async () => {
  const res = await useApiFetch(`/api/message/`);
  // console.log(res);
  messages.value.push(...res.data.value.messages);
});


</script>

<style lang="scss" scoped>
.v-list-item {
  & + & {
    margin-top: 0.5rem;
  }
}
</style>
