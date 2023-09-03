<template>
  <div class="relative">
    <v-container>
      <v-card class="mx-auto h-[100vh]">
        <v-list>
          <v-list-item
            v-for="(message, index) in messages"
            :key="index"
            :prepend-avatar="message.sender_id == auth.user.id ? '' : config.public.baseURL + '/storage/' + message.thumbnail_path"
            rounded="shaped"
            :title="message.sender_id == auth.user.id ? '' : message.title"
            :subtitle="message.comments"
            class="ml-auto"
            :class="message.sender_id == auth.user.id ? 'right' : ''"
          />
        </v-list>
      </v-card>
    </v-container>
    <v-form class="fixed bottom-0 w-100 bg-grey-lighten-3">
        <v-container>
          <v-row >
            <v-col cols="10">
              <AtomsInput
              class="bg-white"
              @emitInput="receiveInput"
              :val="authMessage"
              />
            </v-col>
            <v-col cols="2">
              <AtomsBtnsArrowBtn
              @emitClick="receiveClick"
              />
            </v-col>
          </v-row>
        </v-container>
      </v-form>
  </div>
</template>

<script setup lang="ts">
import { useRuntimeConfig, navigateTo, useRoute } from "nuxt/app";
import { onMounted, ref } from "vue";
import { useAuthStore } from "../../../../stores/useAuthStore";
import {Url} from '../../../../constants/url';

const auth = useAuthStore();
const config = useRuntimeConfig();
const router = useRoute();
const messages = ref([]);
const authMessage = ref('');

const receiveInput= (val)=> {
  authMessage.value = val.value
}

const receiveClick = async () => {

    const data = {
     'comments': authMessage.value,
     'sender_id':auth.user.id,
     'receiver_id':router.params.id,
     'distinction':'all'
    }

    await useApiFetch("/sanctum/csrf-cookie");
    const res = await useApiFetch("/api/message/register", {
    method: "POST",
    body: data
  });

  const senderId = auth.user.id;
  const messages = await useApiFetch(`/api/message/${senderId}`);
  const val = messages.data.value;

  // console.log(val);
  return navigateTo(Url.REQUESTS+`/${router.params.id}`)
}

onMounted(async () => {
  const senderId = router.params.id;
  const res = await useApiFetch(`/api/message/sns/${senderId}`);
  const val = res.data.value;
  messages.value.push(...val.data);
  // console.log(res);
});
</script>

<style lang="scss" scoped>
.v-list {
  &-item {
    & + & {
      margin-top: 0.5rem;
    }

    &.right {
      display: flex;
      flex-direction: row-reverse;
    }

    &-prepend{
      align-self: flex-start;
    }

    &-subtitle {
      overflow: visible;
      -webkit-line-clamp: unset;
      border:1px solid #333 !important;
    }
  }
}

</style>
