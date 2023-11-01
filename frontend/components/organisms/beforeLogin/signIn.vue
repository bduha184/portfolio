<template>
  <div>
    <v-container>
        <v-row>
          <v-col cols="12" sm="6"
          class="text-center"
          >
            <AtomsBtnsSnsBtn
            width="250"
            >
              <AtomsImgs
                size="contain"
                :src="`${config.public.appURL}/_nuxt/assets/images/google.png`"
                width="20"
                height="20"
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
            >
              <AtomsImgs
                size="contain"
                :src="`${config.public.appURL}/_nuxt/assets/images/twitter.png`"
                width="20"
                height="20"
                class="absolute left-2"
                />
                <p>
                  Lineでログイン
                </p>
            </AtomsBtnsSnsBtn>
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
      <p
      v-show="postError"
      class="text-body-2 text-red"
      >
          ※メールアドレスまたはパスワードが一致しません
      </p>
      <AtomsBtnsBaseBtn
        width="16rem"
        setColor="orange"
        class="my-4 d-block mx-auto"
        :disabled="!checkFilledOut"
        @emitClick="handleLogin"
      >
        ログイン
      </AtomsBtnsBaseBtn>
    </form>
  </div>
</template>

<script setup lang="ts">
import { useAuthStore } from "../../../stores/useAuthStore";
import { ref, computed } from "vue";
import { navigateTo } from "nuxt/app";
import { useRouter } from "vue-router";
import { Url } from "../../../constants/url";
import {useRuntimeConfig} from 'nuxt/app';

const config = useRuntimeConfig();

const router = useRouter();
const form = ref({
  email: "",
  password: "",
  errors: "",
});

const postError = ref(false);

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

const auth = useAuthStore();
const handleLogin = async () => {
  await auth.login(form.value)
  .then((res)=>{
    if (res.error.value == null) {
      navigateTo(Url.MYPAGE);
    }
  }).catch((e)=>{
    postError.value = true;
  })

};
</script>

<style scoped lang="scss">
.v-btn:deep(.v-responsive){
  position: absolute !important;
}

</style>
