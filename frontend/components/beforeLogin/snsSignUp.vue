<template>
  <div>
    <form method="POST">
      <div class="text-caption">
        <span class="text-red">※</span>は必須項目です
      </div>
      <FormName @setName="receiveName" :name="form.name"/>
      <FormEmail @setEmail="receiveEmail" :name="form.email"/>
      <ButtonCommon
        btnValue="登録"
        place="MAIN"
        width="16rem"
        setColor="orange"
        class="my-4 d-block"
        :disabled="!checkFilledOut()"
        @click.prevent="snsHandleRegister"
      />
    </form>
  </div>
</template>

<script setup lang="ts">
import { useAuthStore } from "../../stores/useAuthStore";
import {ref} from 'vue';
import { navigateTo } from "nuxt/app";
import {useRoute} from 'vue-router';

const route = useRoute();

const form = ref({
  name:'',
  email:route.query.email,
  provider:route.query.provider,
  token:route.query.token,
})

const checkFilledOut = () => {

  const fieldArray = [
    form.value.name,
    form.value.email,
  ]

  if(fieldArray.indexOf('') === -1){
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
async function snsHandleRegister() {

  const {error} = await auth.providerRegister(form.value);
  if(error.value == null){
    navigateTo('/auth');
  }else{
    navigateTo('/beforeLogin');
  }
}

</script>

<style scoped lang="scss"></style>
