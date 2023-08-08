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
      <FormPasswordConfirm @setPasswordConfirmation="receivePasswordConfirmation" :name="form.password_confirmation" :confirm="form.confirm"/>
      <FormConsent @setCheck="receiveCheck" :name="form.check"/>
      <ButtonCommon
        btnValue="登録"
        place="MAIN"
        width="16rem"
        setColor="orange"
        class="my-4 d-block"
        :disabled="!checkFilledOut()"
        @click="handleRegister"
      />
    </form>
  </div>
</template>

<script setup lang="ts">
import { useAuthStore } from "../../stores/useAuthStore";
import {ref,computed} from 'vue';
import { navigateTo } from "nuxt/app";
const form = ref({
  name:'',
  email:'',
  password:'',
  password_confirmation:'',
  check:'',
  confirm:false

})

const checkFilledOut = () => {

  const fieldArray = [
    form.value.name,
    form.value.email,
    form.value.password,
    form.value.password_confirmation,
  ]

  if(form.value.password != form.value.password_confirmation){
    form.value.confirm = false;
    return false;
  }else{
    form.value.confirm = true;
  }

  if(fieldArray.indexOf('') === -1 && form.value.check){
    return true;
  }
}


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

const receiveCheck = (setCheck) => {
  form.value.check = setCheck;
};
async function handleRegister() {

  const {error} = await auth.register(form.value);
  if(!error.value){
    navigateTo('/auth');
  }else{
    navigateTo('/beforeLogin');
  }
}

</script>

<style scoped lang="scss"></style>
