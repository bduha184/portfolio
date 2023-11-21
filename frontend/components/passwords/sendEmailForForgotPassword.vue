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
import { useAuthStore } from "~/stores/useAuthStore";
import {ref,computed} from '#imports';
const form = ref({
  email:'',
})

const message = ref();

const checkFilledOut = computed(() => {

  const fieldArray = [
    form.value.email,
  ]

  if(fieldArray.indexOf('') === -1){
    return true;
  }
})


const auth = useAuthStore();
const receiveEmail = (receiveEmail) => {
  form.value.email = receiveEmail;
};
async function handleSendEmail() {

  const res = await auth.forgotPassword(form.value.email);
  console.log(res);
    // message.value = res.data.value.status;
}

</script>

<style scoped lang="scss"></style>
