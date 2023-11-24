<script setup lang="ts">
import {
  ref,
  useRuntimeConfig,
  navigateTo,
  useRoute,
  computed,
  onMounted,
  watch,
} from "#imports";
import { useAuthStore } from "../../../../stores/useAuthStore";
import { Url } from "../../../../constants/url";

const auth = useAuthStore();
const config = useRuntimeConfig();
const router = useRoute();
const messages = ref([]);
const pusherMessages = ref([]);
const authMessage = ref("");

const receiveInput = (val) => {
  authMessage.value = val.value;
};
const senderId = auth.user.id;

const receiveClick = async () => {
  pusherMessages.value.push(authMessage.value);
  const data = {
    comment: authMessage.value,
    sender_id: auth.user.id,
    receiver_id: router.params.id,
    distinction: "all",
  };

  await useApiFetch("/sanctum/csrf-cookie");
  const res = await useApiFetch("/api/message/register", {
    method: "POST",
    body: data,
  });

  // window.Pusher.logToConsole = true;

  // console.log(val);
  // return navigateTo(Url.REQUESTS + `/${router.params.id}`);
};

// window.Echo.channel(`cycle-community`).listen(".new-message-event", (e) => {
//   console.log(e);
//   // messages.value.push(e.message.comment);
//   // const senderId = router.params.id;
//   // const res = await useApiFetch(`/api/message/sns/${senderId}`);
//   // const val = res.data.value;
//   // messages.value.push(...val.data);
// });

onMounted(async () => {
  const senderId = router.params.id;
  const res = await useApiFetch(`/api/message/sns/${senderId}`);
  const val = res.data.value;
  messages.value.push(...val.data);
});
</script>

<template>
  <v-container>
    <AtomsTextsHeadLine> チーム活動内容 </AtomsTextsHeadLine>
    <v-card-text>
      {{ activities }}
    </v-card-text>
  </v-container>
</template>

<style lang="scss" scoped>
.v-list {
  &-item {
    & + & {
      margin-top: 0.5rem;
    }

    &.right {
      display: flex;
      flex-direction: row-reverse;

      &:deep(.v-list-item-subtitle) {
        background: #2196f3;

        &::before {
          content: none;
        }
        &::after {
          border-radius: 0 20px 20px 10px/0 20px 20px 1px;
          box-shadow: inset 3px -15px 0 -5px #2196f3;
          right: -8px;
        }
      }
    }

    &-prepend {
      align-self: flex-start;
    }

    &:deep(.v-list-item__content) {
      overflow: visible;
    }

    &:deep(.v-list-item-subtitle) {
      display: inline-block;
      overflow: visible;
      -webkit-line-clamp: unset;
      // border: 1px solid #333 !important;
      padding: 10px 15px;
      border-radius: 20px;
      line-height: 1;
      background: gray;
      color: #fff;
      position: relative;
      z-index: 0;

      &::before,
      &::after {
        content: "";
        display: block;
        width: 18px;
        height: 20px;
        position: absolute;
        z-index: -1;
        top: -5px;
      }

      &::before {
        border-radius: 20px 0px 10px 20px/20px 0 1px 20px;
        box-shadow: -3px -15px 0 -5px gray inset;
        left: -8px;
      }
    }
  }
}
</style>
