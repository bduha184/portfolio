<script setup lang="ts">
import { useAuthStore } from "~/stores/useAuthStore";
import { useFlashMessageStore } from "~/stores/useFlashMessageStore";
import { Url } from "~/constants/url";
import { Message } from "~/constants/flashMessage";

const flashMessage = useFlashMessageStore();
const form = ref({
  password: "",
  password_confirmation: "",
});

const formCheck = ref({
  confirm: false,
  errors: "",
});

const route = useRoute();

const message = ref();

const checkFilledOut = computed(() => {
  const fieldArray = [form.value.password, form.value.password_confirmation];

  const errors = Object.keys(formCheck.value.errors).length;

  if (form.value.password != form.value.password_confirmation) {
    formCheck.value.confirm = false;
  } else {
    formCheck.value.confirm = true;
  }
  if (fieldArray.indexOf("") === -1 && errors == 0) {
    return true;
  } else {
    return false;
  }
});

const auth = useAuthStore();
const receivePassword = (val) => {
  form.value.password = val.val;
  formCheck.value.errors = val.errors;
};
const receivePasswordConfirmation = (val) => {
  form.value.password_confirmation = val.val;
  formCheck.value.errors = val.errors;
};
async function handleSendEmail() {
  const token = route.query.token;
  const email = route.query.email;
  const password = form.value.password;
  const password_confirmation = form.value.password_confirmation;
  const res = await auth.resetPassword(
    token,
    email,
    password,
    password_confirmation
  );

  if (res.error.value != null) {
    const errors = res.error.value.data.errors;
    if (errors) {
      if (errors.password) {
        flashMessage.setMessage(Message.RESETPASSWORDERROR, "error", 8000);
        return false;
      }
    }
  } else {
    flashMessage.setMessage(Message.RESETPASSWORD);
    return navigateTo(Url.SIGNIN);
  }
}
</script>

<template>
  <div>
    <form method="POST">
      <h2 class="text-center text-h5 mb-5">パスワード再設定</h2>
      <div class="text-caption">
        <span class="text-red">※</span>は必須項目です
      </div>
      <MoleculesInput
        type="password"
        label="パスワード"
        @emitInput="receivePassword"
        :val="form.password"
        class="mb-4"
      />
      <MoleculesInput
        type="password"
        label="パスワード（確認）"
        @emitInput="receivePasswordConfirmation"
        :val="form.password_confirmation"
        :confirm="form.confirm"
        class="mb-4"
      />
      <AtomsBtnsBaseBtn
        width="16rem"
        color="info"
        class="my-4 d-block mx-auto"
        :disabled="!checkFilledOut"
        @emitClick="handleSendEmail"
      >
        登録する
      </AtomsBtnsBaseBtn>
    </form>
  </div>
</template>
