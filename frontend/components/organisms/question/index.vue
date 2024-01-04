<template>
  <div>
    <form method="POST">
      <h2 class="text-center text-h5 mb-5">パスワード再設定</h2>
      <p
      class="bg-blue-100 text-center mb-5 p-2 "
      v-show="message"
      >{{ message }}</p>
      <div class="text-caption">
        <span class="text-red">※</span>は必須項目です
      </div>
      <MoleculesInput
        type="email"
        label="メールアドレス"
        @emitInput="receiveEmail"
        :val="form.email"
        class="mb-4"
      />
      <AtomsBtnsBaseBtn
        width="16rem"
        color="info"
        class="my-4 d-block mx-auto"
        :disabled="!checkFilledOut"
        @emitClick="handleSendEmail"
      >
        メール送信
      </AtomsBtnsBaseBtn>

    </form>
  </div>
</template>

<script setup lang="ts">
import { Url } from "~/constants/url";

const messages = ref([]);

const onClick = (id) => {
  return navigateTo(`${Url.REQUESTS}/${id}`);
};

onMounted(async () => {
  const dist = "que";
  const res = await useApiFetch(`/api/message/${dist}`);
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
