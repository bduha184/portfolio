<template>
  <div>
    <ButtonSns />
    <div class="supplement text-center my-4">or</div>
    <form method="POST" @submit.prevent="handleLogin">
      <div class="text-caption">
        <span class="text-red">※</span>は必須項目です
      </div>
      <UserFormName @setName="receiveName" :name="name" />
      <UserFormPassword @setPass="receivePass" :name="pass" />
      <ButtonCommon
        btnValue="ログイン"
        place="MAIN"
        width="16rem"
        setColor="orange"
        class="my-4 d-block"
        type="submit"
      />
    </form>
  </div>
</template>

<script setup lang="ts">
// import { Form } from "vee-validate";
import * as Yup from "yup";
import { ref, reactive } from "vue";
import {useAuthStore} from "~/stores/useAuthStore";

// const name = ref('user');
// const pass = ref('password');

const form = ref({
  name:'user',
  password:'password'
})

const auth = useAuthStore();

const receiveName = (setName) => {
  form.value.name = setName;
};

const receivePass = (setPass) => {
  form.value.pass = setPass;
};

async function handleLogin() {

  const {error} = await auth.login(form.value);


  console.log(error);
}
</script>

<style scoped lang="scss"></style>
