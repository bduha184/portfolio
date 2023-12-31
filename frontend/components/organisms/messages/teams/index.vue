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
          :subtitle="message.comment"
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
    <v-form class="message fixed bottom-0 left-0 w-100">
      <v-container>
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
              color="info"
            />
          </v-col>
        </v-row>
      </v-container>
    </v-form>
  </div>
</template>

<script setup lang="ts">
import { useAuthStore } from "~/stores/useAuthStore";
import { useTeamStore } from "~/stores/useTeamStore";

const auth = useAuthStore();
const config = useRuntimeConfig();
const router = useRoute();
const teamStore = useTeamStore();
const messages = ref([]);
const pusherMessages = ref([]);
const authMessage = ref("");
const teamId = router.params.id;
const senderId = auth.user.id;

const receiveInput = (val) => {
  authMessage.value = val.value;
};

const checkFilledOut = computed(() => {
  if (authMessage.value) return false;
  return true;
});

const receiveClick = async () => {
  pusherMessages.value.push(authMessage.value);
  const data = {
    comment: authMessage.value,
    team_id: teamId,
    sender_id: senderId,
  };

  await useApiFetch("/sanctum/csrf-cookie");
  const res = await useApiFetch("/api/message/register", {
    method: "POST",
    body: data,
  });

};

window.Echo.channel(`cycle-community`).listen(
  ".new-message-event",
  async (e) => {
    console.log(e);
    if(senderId != e.user.id) pusherMessages.value.push(e.message.comment);
  }
);

onMounted(async () => {
  const teamId = router.params.id;
  await useApiFetch(`/api/message/teams/${teamId}`).then((res) => {
    if (res.data != null) {
      messages.value.push(...res.data.value.messages);
    }
  });
});
</script>

<style lang="scss" scoped>


.message {
    &:deep(.v-container) {
    max-width: 500px !important;
    padding: 0 1rem !important;
  }
}
.v-list {
  &:deep(.v-list-item) {
    // width: calc(100% - 30px) !important;
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
