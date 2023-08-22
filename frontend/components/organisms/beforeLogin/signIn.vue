<template>
  <div>
    <v-container>
      <v-row>
        <v-col>
          <AtomsBtnsSnsBtn
            provider="google"
            class="d-block mx-auto border-2 border-indigo-500 w-[250px]"
            >
            Googleでログイン
          </AtomsBtnsSnsBtn>
          </v-col>
          <v-col>
            <AtomsBtnsSnsBtn
            provider="twitter"
            class="d-block mx-auto border-2 border-indigo-500 w-[250px]"
          >
          Lineでログイン
        </AtomsBtnsSnsBtn>
        </v-col>
      </v-row>
    </v-container>
    <div
      class="text-center my-4 relative before:absolute before:left-0 before:top-50 before:h-[1px] before:w-full before:bg-slate-600 z-0"
    >
      or
    </div>
    <form method="POST">
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
        <MoleculesInput
        type="password"
        label="パスワード"
        @emitInput="receivePassword"
        :val="form.password"
        class="mb-4"
        />
      <AtomsBtnsBaseBtn
        width="16rem"
        setColor="orange"
        class="my-4 d-block"
        :disabled="!checkFilledOut()"
        @click="handleLogin"
      >
        ログイン
      </AtomsBtnsBaseBtn>
    </form>
  </div>
</template>

<script setup lang="ts">
import { useAuthStore } from "../../../stores/useAuthStore";
import {ref,computed} from 'vue';
import { navigateTo } from "nuxt/app";
const form = ref({
  email:'',
  password:'',

})

const checkFilledOut = () => {

  const fieldArray = [
    form.value.email,
    form.value.password,
  ]

  if(fieldArray.indexOf('') === -1){
    return true;
  }
}


const auth = useAuthStore();
const receiveEmail = (receiveEmail) => {
  form.value.email = receiveEmail;
};
const receivePassword = (receivePassword) => {
  form.value.password = receivePassword;
};
async function handleLogin() {

  const res = await auth.login(form.value);

  if(res.error.value == null){
    navigateTo('/auth');
  }else{
    navigateTo('/beforeLogin');
  }
}

</script>

<style scoped lang="scss"></style>
