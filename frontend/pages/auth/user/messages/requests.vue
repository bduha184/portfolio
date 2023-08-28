<template>
  <div>
    参加希望
    <div
      v-for="(message,index) in messages"
      :key="index"

    >
    {{ message.comments }}
    </div>
  </div>
</template>

<script setup lang="ts">
import {useMessageStore} from '../../../../stores/useMessageStore';
import {onMounted} from 'vue';

const message = useMessageStore();
const messages = message.getMessages;

onMounted(async () => {
  message.messages.length = 0;
  await message.fetchMessages();
})

</script>
