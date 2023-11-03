<template>
  <div>
    <v-container>
      <v-row>
        <v-col cols="12" sm="6" class="text-center">
          <AtomsBtnsSnsBtn width="250">
            <AtomsImgs
              size="contain"
              :src="`${config.public.appURL}/_nuxt/assets/images/google.png`"
              width="20"
              height="20"
              class="absolute left-2"
            />
            <p>Googleで登録</p>
          </AtomsBtnsSnsBtn>
        </v-col>
        <v-col cols="12" sm="6" class="text-center">
          <AtomsBtnsSnsBtn width="250">
            <AtomsImgs
              size="contain"
              :src="`${config.public.appURL}/_nuxt/assets/images/twitter.png`"
              width="20"
              height="20"
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
        :val="formValue.password_confirmation"
        :confirm="formCheck.confirm"
        class="mb-4"
      />
      <MoleculesConcent @emitInput="receiveCheck" :val="formCheck.check" />
      <AtomsBtnsBaseBtn
        width="16rem"
        setColor="orange"
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
import {useAuthStore} from '../../../stores/useAuthStore';
import { ref, computed } from "vue";
import { navigateTo } from "nuxt/app";
import {Url} from '../../../constants/url';
import {useRuntimeConfig} from 'nuxt/app';
import {Message} from '~/constants/flashMessage';
import { useFlashMessageStore } from '../../../stores/useFlashMessageStore';

const config = useRuntimeConfig();
const flashMessage = useFlashMessageStore();
const formValue = ref({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
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
  formValue.value.password_confirmation,
  ];

  const errors = Object.keys(formCheck.value.errors).length;

  if (formValue.value.password != formValue.value.password_confirmation) {
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
  formValue.value.password_confirmation = val.val;
  formCheck.value.errors = val.errors;
};

const receiveCheck = (setCheck) => {
  formCheck.value.check = setCheck;
};
const handleRegister= async ()=> {

   const res =  await auth.register(formValue.value);
   console.log(res);
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
</script>

<style scoped lang="scss">
.v-btn:deep(.v-responsive) {
  position: absolute !important;
}
</style>
