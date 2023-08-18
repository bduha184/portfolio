<template>
  <div>
    <v-container>
      <v-row>
        <v-col>
          <ButtonSns
            btnValue="Googleでログイン"
            img="google"
            provider="google"
            />
          </v-col>
          <v-col>
            <ButtonSns
            btnValue="Lineでログイン"
            img="line"
            provider="line"
          />
        </v-col>
      </v-row>
    </v-container>
    <div class="supplement text-center my-4">or</div>
    <form method="POST">
      <div class="text-caption">
        <span class="text-red">※</span>は必須項目です
      </div>
      <FormEmail @setEmail="receiveEmail" :name="form.email"/>
      <FormPassword @setPassword="receivePassword" :name="form.password"/>
      <ButtonCommon
        btnValue="ログイン"
        place="MAIN"
        width="16rem"
        setColor="orange"
        class="my-4 d-block"
        :disabled="!checkFilledOut()"
        @click="handleLogin"
      />
    </form>
  </div>
</template>

<script setup lang="ts">
// import {Form as VeeForm} from 'vee-validate'
import { ref, reactive } from "vue";
import {useAuthStore} from "../../stores/useAuthStore";
import { navigateTo } from "nuxt/app";
import { copyFileSync } from "fs";
import {Url} from '../../constants/url';

const form = ref({
  email:'',
  password:''
})

const auth = useAuthStore();

const receiveEmail= (email) => {
  form.value.email = email;
};

const receivePassword = (password) => {
  form.value.password = password;
};

const checkFilledOut = () => {

const fieldArray = [
  form.value.email,
  form.value.password,
]

if(fieldArray.indexOf('') === -1) {
  return true;
}

return false
}



async function handleLogin() {



  const {error} = await auth.login(form.value);

  console.log(error);
  if(error.value != null) return navigateTo('beforeLogin');
  if(auth.isLoggedIn){
    return navigateTo('/auth');
  }else {
    return navigateTo('/beforeLogin');
}



}
</script>

<style scoped lang="scss"></style>
