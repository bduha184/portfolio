<template>
  <div>
    <h2>Googleアカウントで登録</h2>
    <form>
      <div class="text-caption">
        <span class="text-red">※</span>は必須項目です
      </div>
      <MoleculesInput
        type="text"
        label="ユーザーネーム"
        @emitInput="receiveName"
        :val="form.name"
        class="mb-4"
      />
      <AtomsLabelsFormLabel>
        メールアドレス
      </AtomsLabelsFormLabel>
      <div>{{ form.email }}</div>
      <AtomsBtnsBaseBtn
        width="16rem"
        color="info"
        class="my-4 d-block mx-auto"
        :disabled="!checkFilledOut"
        @emitClick="handleRegister"
      >
        登録
      </AtomsBtnsBaseBtn>
    </form>
  </div>
</template>

<script setup lang="ts">
import { useAuthStore } from "../../../stores/useAuthStore";
import {ref} from 'vue';
import { navigateTo } from "nuxt/app";
import {useRoute} from 'vue-router';
import { useFlashMessageStore } from "~/stores/useFlashMessageStore";
import {Message} from '~/constants/flashMessage';
const route = useRoute();
const flashMessage = useFlashMessageStore();
const form = ref({
  name:'',
  email:route.query.email,
  provider:route.query.provider,
  token:route.query.token,
})

const checkFilledOut = () => {

  const fieldArray = [
    form.value.name,
  ]

  if(fieldArray.indexOf('') === -1){
    return true;
  }
}

const auth = useAuthStore();
const receiveName= (receiveName) => {
  form.value.name = receiveName.val.value;
};

const handleRegister= async() => {

  const res = await auth.providerRegister(form.value);
  if(res.error.value == null){
    flashMessage.setMessage(Message.REGISTER);
    navigateTo('/auth');
  }else{
    flashMessage.setMessage(Message.REGISTERERROR,'error',6000);
    navigateTo('/beforelogin');
  }
}

</script>

<style scoped lang="scss"></style>
