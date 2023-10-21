<template>
  <div class="relative">
    <v-card class="mx-auto h-[100vh] overflow-y-auto">
      <v-list>
        <v-list-item
          v-for="(message, index) in messages"
          :key="index"
          :prepend-avatar="
            message.sender_id == auth.user.id
              ? ''
              : config.public.baseURL + '/storage/' + message.thumbnail_path
          "
          rounded="shaped"
          :title="message.sender_id == auth.user.id ? '' : message.title"
          :subtitle="message.comments"
          class="ml-auto"
          :class="message.sender_id == auth.user.id ? 'right' : ''"
        />
        <v-list-item
          v-for="(message, index) in pusherMessages"
          :key="index"
          :subtitle="message"
          class="right"
        />
      </v-list>
    </v-card>
    <v-form class="fixed bottom-0 left-0 w-100">
      <v-container>
        <AtomsBtnsBaseBtn
          class="mb-6 ml-2"
          v-if="request_flg"
          @emitClick="allowJoinTeam"
        >
          参加申請を許可する
        </AtomsBtnsBaseBtn>
        <v-row class="bg-grey-lighten-3">
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
              :disabled="checkFilledOut"
            />
          </v-col>
        </v-row>
      </v-container>
    </v-form>
  </div>
</template>

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
import { useAuthStore } from "../../../stores/useAuthStore";
import { Url } from "../../../constants/url";
import { ApprovalMessage } from "../../../constants/teams";

const auth = useAuthStore();
const config = useRuntimeConfig();
const router = useRoute();
const messages = ref([]);
const request_flg = ref(false);
const pusherMessages = ref([]);
const authMessage = ref("");
const receiveInput = (val) => {
  authMessage.value = val.value;
};

const checkFilledOut = computed(() => {
  if (authMessage.value) return false;
  return true;
});

const authId = auth.user.id;
const sender_id = router.params.id;

watch(pusherMessages.value, async () => {
  const pusherData = {
    comments: pusherMessages.value[0],
    sender_id: authId,
    receiver_id: sender_id,
  };
  if (pusherMessages.value.length > 0) {
    await useApiFetch("/sanctum/csrf-cookie");
    await useApiFetch("/api/message/register", {
      method: "POST",
      body: pusherData,
      // headers: {
      //   "X-HTTP-Method-Override": "PUT",
      // },
    }).then((res) => {
      console.log(res);
    });
  }
});

const allowJoinTeam = async () => {
  pusherMessages.value.push(ApprovalMessage);
  request_flg.value = false;

  await Promise.all([
    useApiFetch("/sanctum/csrf-cookie"),
    useApiFetch(`/api/profile/${sender_id}`, {
      method: "POST",
      body: {
        request_flg: request_flg.value,
      },
      headers: {
        "X-HTTP-Method-Override": "PUT",
      },
    }),
  ]).then((res) => {
    console.log(res);
  });

  // return navigateTo(`${Url.MESSAGES}/details/${router.params.id}`);
};

const receiveClick = async () => {
  messages.value.push(authMessage.value);
  const data = {
    comments: authMessage.value,
    sender_id: sender_id,
    receiver_id: authId,
  };

  await useApiFetch("/sanctum/csrf-cookie");
  const res = await useApiFetch("/api/message/register", {
    method: "POST",
    body: data,
  });

  // window.Pusher.logToConsole = true;

  console.log(res);
  // return navigateTo(Url.REQUESTS + `/${router.params.id}`);
};

// window.Echo.channel(`cycle-community`).listen(".new-message-event", (e) => {
//   console.log(e);
//   // messages.value.push(e.message.comments);
//   // const senderId = router.params.id;
//   // const res = await useApiFetch(`/api/message/sns/${senderId}`);
//   // const val = res.data.value;
//   // messages.value.push(...val.data);
// });

onMounted(async () => {
  request_flg.value = false;
  const senderId = router.params.id;
  const flg = router.query.flg;
  if (flg == 1) request_flg.value = true;
  await useApiFetch(`/api/message/${senderId}`).then((res) => {
    console.log(res);
    if (res.data) {
      messages.value.push(...res.data.value.data);
    }
  });
});
</script>

<style lang="scss" scoped>
.v-list {
  &:deep(.v-list-item) {
    width: calc(100% - 30px) !important;
    margin-right: auto;
  }
  &-item {
    & + & {
      margin-top: 0.5rem;
    }

    &.right {
      display: flex;
      flex-direction: row-reverse;
      margin-left: auto !important;

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
