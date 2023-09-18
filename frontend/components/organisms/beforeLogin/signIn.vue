<template>
  <div>
    <v-container>
      <v-row>
        <v-col>
          <MoleculesBtnsSnsBtn
            provider="google"
            class="d-flex mx-auto border-2 border-indigo-500 w-[250px]"
            >
            Googleでログイン
          </MoleculesBtnsSnsBtn>
          </v-col>
          <v-col>
            <MoleculesBtnsSnsBtn
            provider="twitter"
            class="d-block mx-auto border-2 border-indigo-500 w-[250px]"
          >
          Lineでログイン
        </MoleculesBtnsSnsBtn>
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
        class="my-4 d-block mx-auto"
        :disabled="!checkFilledOut"
        @emitClick="handleLogin"
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
import {useRouter} from 'vue-router';
import {Url} from '../../../constants/url';

const router = useRouter();
const form = ref({
  email:'',
  password:'',
  errors:''
})

const receiveEmail = (val) => {
  form.value.email = val.val;
  form.value.errors = val.errors;
};
const receivePassword = (val) => {
  form.value.password = val.val;
  form.value.errors = val.errors;
};
const checkFilledOut = computed(() => {

  const fieldArray = [
    form.value.email,
    form.value.password,
  ]

  const errors = Object.keys(form.value.errors).length;

  if(fieldArray.indexOf('') === -1 && errors == 0){
    return true;
  }
})


const auth = useAuthStore();
async function handleLogin() {

  const res = await auth.login(form.value);

   if (res.error.value == null) {
    navigateTo(Url.MYPAGE);
  } else {
    navigateTo(Url.SIGNUP);
  }
}

</script>

<style scoped lang="scss"></style>
