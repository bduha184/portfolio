<template>
  <div>
    <form method="POST">
      <h2 class="text-center text-h5 mb-5">パスワード再設定</h2>
      <p class="bg-blue-100 text-center mb-5 p-2" v-show="message">
        {{ message }}
      </p>
      <div class="text-caption">
        <span class="text-red">※</span>は必須項目です
      </div>
      <FormPassword @setPassword="receivePassword" :name="form.password" />
      <FormPasswordConfirm
        @setPasswordConfirmation="receivePasswordConfirmation"
        :name="form.password_confirmation"
        :confirm="form.confirm"
      />
      <ButtonCommon
        btnValue="パスワード再設定"
        place="MAIN"
        width="16rem"
        setColor="orange"
        class="my-4 d-block"
        :disabled="!checkFilledOut()"
        @click.prevent="handleSendEmail"
      />
    </form>
  </div>
</template>
import { PasswordsResetPasswordForm } from "../../.nuxt/components";

<script setup lang="ts">
import { useAuthStore } from "../../stores/useAuthStore";
import { ref } from "vue";
import { useRoute } from "vue-router";
import { navigateTo } from "nuxt/app";
const form = ref({
  password: "",
  password_confirmation: "",
  confirm: false,
});

const route = useRoute();


const message = ref();

const checkFilledOut = () => {
  const fieldArray = [form.value.password, form.value.password_confirmation];

  if (form.value.password != form.value.password_confirmation) {
    form.value.confirm = false;
    return false;
  } else {
    form.value.confirm = true;
  }

  if (fieldArray.indexOf("") === -1) {
    return true;
  }
};

const auth = useAuthStore();
const receivePassword = (setPassword) => {
  form.value.password = setPassword;
};
const receivePasswordConfirmation = (setPasswordConfirmation) => {
  form.value.password_confirmation = setPasswordConfirmation;
};


async function handleSendEmail() {
  const token = route.query.token;
  const email = route.query.email;
  const password = form.value.password;
  const password_confirmation = form.value.password_confirmation;
  const res = await auth.resetPassword(token,email,password,password_confirmation);

    message.value = res.data.value.status;

    if(res.error.value == null){
      setTimeout(() => {
        return navigateTo('/auth');
      }, 2500);
    }
}
</script>

<style scoped lang="scss"></style>
