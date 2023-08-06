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
      <FormName @setName="receiveName" :name="form.name"/>
      <FormEmail @setEmail="receiveEmail" :name="form.email"/>
      <FormPassword @setPassword="receivePassword" :name="form.password"/>
      <FormPasswordConfirm @setPasswordConfirmation="receivePasswordConfirmation" :name="form.password_confirmation"/>
      <FormConsent />
      <ButtonCommon
        btnValue="登録"
        place="MAIN"
        width="16rem"
        setColor="orange"
        class="my-4 d-block"
        :disabled="isSubmitting"
        @click="handleRegister"
      />
    </form>
  </div>
</template>

<script setup lang="ts">
import { useForm} from "vee-validate";

import { useAuthStore } from "../../stores/useAuthStore";
import {ref} from 'vue';
import { navigateTo } from "nuxt/app";
const form = ref({
  name:'',
  email:'',
  password:'',
  password_confirmation:'',
})

const {isSubmitting} = useForm();

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

  await new Promise((resolve)=>setTimeout(async() => {
    const {error} = await auth.register(form.value);
    if(!error.value){
      navigateTo('/auth');
    }
  }, 1000))

}

</script>

<style scoped lang="scss"></style>
