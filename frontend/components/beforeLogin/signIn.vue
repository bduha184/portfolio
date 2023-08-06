<template>
  <div>
    <ButtonSns />
    <div class="supplement text-center my-4">or</div>
    <form method="POST" >
      <div class="text-caption">
        <span class="text-red">※</span>は必須項目です
      </div>
      <FormEmail  @setEmail="receiveEmail" :name="form.email" />
      <FormPassword @setPassword="receivePassword" :name="form.password" />
      <ButtonCommon
        btnValue="ログイン"
        place="MAIN"
        width="16rem"
        setColor="orange"
        class="my-4 d-block"
        type="submit"
        @click.prevent="handleLogin"
      />
    </form>
    {{ form }}
    {{ auth }}
  </div>
</template>

<script setup lang="ts">
// import {Form as VeeForm} from 'vee-validate'
import { ref, reactive } from "vue";
import {useAuthStore} from "../../stores/useAuthStore";
import { navigateTo } from "nuxt/app";

const form = ref({
  email:'',
  password:''
})

const auth = useAuthStore();

const receiveEmail= (newEmail) => {
  form.value.email = newEmail;
};

const receivePassword = (newPassword) => {
  form.value.password = newPassword;
};


async function handleLogin() {

  const {error} = await auth.login(form.value);

  console.log(error);
  if(error.value != null) return navigateTo('beforeLogin');
  console.log(auth);
  if(auth.isLoggedIn){
    return navigateTo('/auth');
  }else {
    return navigateTo('/beforeLogin');
}



}
</script>

<style scoped lang="scss"></style>
