<template>
  <div>
    <ButtonSns />
    <div class="supplement text-center my-4">or</div>
    <form method="POST" >
      <div class="text-caption">
        <span class="text-red">※</span>は必須項目です
      </div>
      <UserFormEmail @setEmail="receiveEmail" :name="form.value" />
      <UserFormPassword @setPass="receivePass" :name="form.value" />
      <ButtonCommon
        btnValue="ログイン"
        place="MAIN"
        width="16rem"
        setColor="orange"
        class="my-4 d-block"
        type="submit"
        @click="handleLogin"
      />
    </form>
    {{ receive }}
  </div>
</template>

<script setup lang="ts">
// import { Form } from "vee-validate";
import * as Yup from "yup";
import { ref, reactive } from "vue";
import {useAuthStore} from "../../stores/useAuthStore";
import { navigateTo } from "nuxt/app";

// const name = ref('user');
// const pass = ref('password');

const form = ref({
  email:'sample@sample.com',
  password:'password'
})

const receive = ref();

const auth = useAuthStore();

const receiveEmail= (setPass) => {
  form.value = setPass;
};

const receivePass = (setPass) => {
  form.value = setPass;
};

async function handleLogin() {

  const {error} = await auth.login(form.value);


  console.log(error);
//   receive.value = error;

// if(auth.isLoggedIn){
//   console.log('test');
//   return navigateTo('/auth');
// }else {
//   console.log('test');
//   return navigateTo('/beforeLogin');
// }


}
</script>

<style scoped lang="scss"></style>
