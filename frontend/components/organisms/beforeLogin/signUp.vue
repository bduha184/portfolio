<template>
  <div>
    <v-container>
      <v-row>
        <v-col>
          <AtomsBtnsSnsBtn
            provider="google"
            class="d-block mx-auto border-2 border-indigo-500 w-[250px]"
          >
            Googleで登録
          </AtomsBtnsSnsBtn>
        </v-col>
        <v-col>
          <AtomsBtnsSnsBtn
            provider="twitter"
            class="d-block mx-auto border-2 border-indigo-500 w-[250px]"
          >
            Lineで登録
          </AtomsBtnsSnsBtn>
        </v-col>
      </v-row>
    </v-container>
    <div
      class="text-center my-4 relative before:absolute before:left-0 before:top-50 before:h-[1px] before:w-full before:bg-slate-600 z-0"
    >
      or
    </div>
    <form method="POST">
      <div class="text-caption">
        <span class="text-red">※</span>は必須項目です
      </div>
      <MoleculesInput
        type="text"
        label="ユーザーネーム"
        @emitInput="receiveName"
        :val="form.name"
        class="mb-4"
        />
        <MoleculesInput
        type="email"
        label="メールアドレス"
        @emitInput="receiveEmail"
        :val="form.email"
        class="mb-4"
        />
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
        <MoleculesConcent @emitInput="receiveCheck" :val="form.check" />
      <AtomsBtnsBaseBtn
        width="16rem"
        setColor="orange"
        class="my-4 d-block"
        :disabled="!checkFilledOut()"
        @click="handleRegister"
      >
        登録
      </AtomsBtnsBaseBtn>
    </form>
  </div>
</template>

<script setup>
import { useAuthStore } from "../../../stores/useAuthStore";
import { ref, computed } from "vue";
import { navigateTo } from "nuxt/app";
const form = ref({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  check: "",
  confirm: true,
});



const check = (value) => {
  form.value.check = value;
};

const checkFilledOut = () => {
  const fieldArray = [
    form.value.name,
    form.value.email,
    form.value.password,
    form.value.password_confirmation,
  ];

  if (form.value.password != form.value.password_confirmation) {
    form.value.confirm = false;
    return false;
  } else {
    form.value.confirm = true;
  }

  if (fieldArray.indexOf("") === -1 && form.value.check) {
    return true;
  }
};

const auth = useAuthStore();
const receiveName = (val) => {
  form.value.name = val;
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
  const res = await auth.register(form.value);

  if (res.error.value == null) {
    navigateTo("/auth");
  } else {
    navigateTo("/beforeLogin");
  }
}
</script>
