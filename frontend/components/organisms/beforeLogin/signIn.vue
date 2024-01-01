<template>
  <div>
    <v-container>
        <v-row>
          <v-col cols="12" sm="6"
          class="text-center"
          >
            <AtomsBtnsSnsBtn
            width="250"
            @emitClick="receiveClick('google')"
            >
            <AtomsImgs
            size="contain"
            :src="`${config.public.appURL}/images/google.png`"
            :width=20
            :height=20
            class="absolute left-2"
            />
            <p>
              Googleでログイン
            </p>
          </AtomsBtnsSnsBtn>
        </v-col>
        <v-col cols="12" sm="6"
        class="text-center"
        >

        <AtomsBtnsSnsBtn
        width="250"
        @emitClick="receiveClick('line')"
            >
              <AtomsImgs
                size="contain"
                :src="`${config.public.appURL}/images/line.png`"
                :width=25
            :height=25
                class="absolute left-2"
                />
                <p>
                  Lineでログイン
                </p>
            </AtomsBtnsSnsBtn>
          </v-col>
          <v-col>
            <MoleculesBtnsSnsBtn/>
          </v-col>
        </v-row>
    </v-container>
    <v-divider class="my-5 border-opacity-100" color="info"></v-divider>
    <form method="POST">
      <div class="text-caption">
        <span class="text-red">※</span>は必須項目です
      </div>

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
      <AtomsBtnsBaseBtn
      width="16rem"
      color="orange"
      class="my-4 d-block mx-auto login"
      :disabled="!checkFilledOut"
      @emitClick="handleLogin"
      >
      ログイン
    </AtomsBtnsBaseBtn>
    <p class="text-center">パスワードをお忘れの方は
      <NuxtLink
      class="text-info text-decoration-underline"
      :to="Url.RESETPASSWORD"
      >こちら</NuxtLink>
    </p>
    </form>
  </div>
</template>



<script setup lang="ts">
import { useAuthStore } from "~/stores/useAuthStore";
import { useFlashMessageStore } from "~/stores/useFlashMessageStore";
import { Url } from "~/constants/url";
import { Message } from "~/constants/flashMessage";


const config = useRuntimeConfig();
const auth = useAuthStore();
const flashMessage = useFlashMessageStore();

const form = ref({
  email: "",
  password: "",
  errors: "",
});

const receiveEmail = (val) => {
  form.value.email = val.val;
  form.value.errors = val.errors;
};
const receivePassword = (val) => {
  form.value.password = val.val;
  form.value.errors = val.errors;
};
const checkFilledOut = computed(() => {
  const fieldArray = [form.value.email, form.value.password];

  const errors = Object.keys(form.value.errors).length;

  if (fieldArray.indexOf("") === -1 && errors == 0) {
    return true;
  }
});


const handleLogin = async () => {
  console.log(form.value);
 const res =  await auth.login(form.value)
 console.log(res);
    if (res.error.value != null) {
      return flashMessage.setMessage(Message.LOGINERROR,'error',6000);
    }
    flashMessage.setMessage(Message.LOGIN);
    return navigateTo(Url.MYPAGE);

};


const receiveClick = async(provider:string)=> {
  const res = await auth.providerLogin(provider);
  console.log(res);
  window.location.href = res.data.value.redirect_url;
}

</script>


<style scoped lang="scss">
.v-btn{
  &:deep(.v-responsive){
    position: absolute !important;
  }
  &.login{

    color: #fff !important;
  }
}

</style>
