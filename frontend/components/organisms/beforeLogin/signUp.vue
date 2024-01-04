<template>
  <div>
    <v-container>
      <v-row>
        <v-col cols="12" sm="6" class="text-center">
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
          <p>Googleで登録</p>
        </AtomsBtnsSnsBtn>
      </v-col>
      <v-col cols="12" sm="6" class="text-center">
        <AtomsBtnsSnsBtn width="250"
        @emitClick="receiveClick('line')"
        >
            <AtomsImgs
              size="contain"
              :src="`${config.public.appURL}/images/line.png`"
              :width=25
              :height=25
              class="absolute left-2"
            />
            <p>Lineで登録</p>
          </AtomsBtnsSnsBtn>
        </v-col>
      </v-row>
    </v-container>
    <v-divider class="my-5 border-opacity-100" color="waring"></v-divider>
    <form method="POST">
      <div class="text-caption">
        <span class="text-red">※</span>は必須項目です
      </div>
      <MoleculesInput
        type="text"
        label="ユーザーネーム"
        @emitInput="receiveName"
        :val="formValue.name"
        class="mb-4"
      />
      <MoleculesInput
        type="email"
        label="メールアドレス"
        @emitInput="receiveEmail"
        :val="formValue.email"
        class="mb-4"
      />
      <MoleculesInput
        type="password"
        label="パスワード"
        @emitInput="receivePassword"
        :val="formValue.password"
        class="mb-4"
      />
      <MoleculesInput
        type="password"
        label="パスワード（確認）"
        @emitInput="receivePasswordConfirmation"
        :val="formValue.passwordConfirmation"
        :confirm="formCheck.confirm"
        class="mb-4"
      />
      <MoleculesConcent @emitInput="receiveCheck" :val="formCheck.check" />
      <AtomsBtnsBaseBtn
        width="16rem"
        color="info"
        class="my-4 d-block mx-auto"
        :disabled="!checkFilledOut"
        @emitClick="handleRegister"
      >
        登録
      </AtomsBtnsBaseBtn>
    </form>
  </div>
</template>

<script setup>
import {useAuthStore} from "~/stores/useAuthStore";
import {Url} from "~/constants/url";
import {Message} from "~/constants/flashMessage";
import { useFlashMessageStore } from "~/stores/useFlashMessageStore";

const config = useRuntimeConfig();
const flashMessage = useFlashMessageStore();
const formValue = ref({
  name: "",
  email: "",
  password: "",
  passwordConfirmation: "",
});

const formCheck = ref({
  check: false,
  confirm: false,
  errors:'',

})


const checkFilledOut = computed(()=>{
  const fieldArray = [
  formValue.value.name,
  formValue.value.email,
  formValue.value.password,
  formValue.value.passwordConfirmation,
  ];

  const errors = Object.keys(formCheck.value.errors).length;

  if (formValue.value.password != formValue.value.passwordConfirmation) {
    formCheck.value.confirm = false;
  } else {
    formCheck.value.confirm = true;
  }
  if (fieldArray.indexOf("") === -1 && formCheck.value.check && errors == 0) {
    return true
  }else{
    return false
  }

});

const auth = useAuthStore();
const receiveName = (val) => {
  formValue.value.name = val.val;
  formCheck.value.errors = val.errors;
};

const receiveEmail = (val) => {
  formValue.value.email = val.val;
  formCheck.value.errors = val.errors;
};
const receivePassword = (val) => {
  formValue.value.password = val.val;
  formCheck.value.errors = val.errors;
};
const receivePasswordConfirmation = (val) => {
  formValue.value.passwordConfirmation = val.val;
  formCheck.value.errors = val.errors;
};

const receiveCheck = (setCheck) => {
  formCheck.value.check = setCheck;
};
const handleRegister= async ()=> {

   const res =  await auth.register(formValue.value);
   console.log('restest',res);
   if(res.error.value != null){
     const errors = res.error.value.data.errors;
     if (errors) {
      if(errors.name) {
        flashMessage.setMessage(Message.REGISTERNAMEERROR,'error',8000);
        return false;
      }
      if(errors.email) {
        flashMessage.setMessage(Message.REGISTEREMAILERROR,'error',8000);
        return false;
      }
     }
   }else{
     flashMessage.setMessage(Message.REGISTER);
     return navigateTo(Url.MYPAGE);

   }

}

const receiveClick = async(provider)=> {
  const res = await auth.providerLogin(provider);
        window.location.href = res.data.value.redirect_url;
}

</script>

<style scoped lang="scss">
.v-btn:deep(.v-responsive) {
  position: absolute !important;
}
</style>
