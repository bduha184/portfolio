<template>
  <div>
    <v-card class="mx-auto text-left" v-if="messages.length > 0">
      <v-list>
        <v-list-item
          v-for="(message, index) in messages"
          :prepend-avatar="
            config.public.baseURL + '/storage/' + message.thumbnail_path
          "
          :title="message.name"
          :key="index"
          :subtitle="message.comment"
          @click="onClick(message.sender_id, message.request_flg)"
        >
          <template v-slot:append v-if="message.request_flg">
            <AtomsTextsCaution classes="text-red text-caption">
              参加申請が来ています
            </AtomsTextsCaution>
          </template>
        </v-list-item>
      </v-list>
    </v-card>
    <p class="text-red" v-else>※受信メッセージは0件です</p>
  </div>
</template>
<script setup lang="ts">
import { Url } from "~/constants/url";

const config = useRuntimeConfig();
const messages = ref([]);

const onClick = (id, flg) => {
  return navigateTo({
    path: `${Url.MESSAGES}/details/${id}`,
    query: {
      flg: flg,
    },
  });
};

onMounted(async () => {
  await useApiFetch("/api/message/").then((res) => {
    if (res.data.value) {
      const messageItems = res.data.value.messages;
      messages.value.push(...messageItems);
    }
  });
});

</script>

<style lang="scss" scoped>
.v-list-item {
  & + & {
    margin-top: 0.5rem;
  }
}
</style>
