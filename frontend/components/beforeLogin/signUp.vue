<template>
  <div>
    <ButtonSns />
    <div
      class="text-center my-4 relative before:absolute before:left-0 before:top-50 before:h-[1px] before:w-full before:bg-slate-600 z-0"
    >
      or
    </div>
    <form method="POST">
      <div class="text-caption">
        <span class="text-red">※</span>は必須項目です
      </div>
      <UserFormName @setName="receiveName" :name="form.name"/>
      <UserFormEmail @setEmail="receiveEmail" :name="form.email"/>
      <UserFormPassword @setPassword="receivePassword" :name="form.password"/>
      <UserFormPasswordConfirm @setPasswordConfirmation="receivePasswordConfirmation" :name="form.password_confirmation"/>
      <UserFormConsent />
      <ButtonCommon
        btnValue="登録"
        place="MAIN"
        width="16rem"
        setColor="orange"
        class="my-4 d-block"
        @click="handleRegister"
      />
    </form>
  </div>
</template>

<script setup lang="ts">
import { Form } from "vee-validate";
import * as Yup from "yup";
import { useAuthStore } from "../../stores/useAuthStore";
import {ref} from 'vue';
import { navigateTo } from "nuxt/app";
const form = ref({
  name:'',
  email:'',
  password:'',
  password_confirmation:'',
})

const auth = useAuthStore();

const receiveName= (receiveName) => {
  form.value.name = receiveName;
};

const receiveEmail = (receiveEmail) => {
  form.value.email = receiveEmail;
};
const receivePassword = (setPassword) => {
  form.value.password = setPassword;
};
const receivePasswordConfirmation = (setPasswordConfirmation) => {
  form.value.password_confirmation = setPasswordConfirmation;
};

async function handleRegister() {

  const {error} = await auth.register(form.value);

  if(!error.value){
    navigateTo('/auth');
  }

}

</script>

<style scoped lang="scss"></style>
