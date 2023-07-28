<template>
  <div class="p-4">
    <v-container class="bg-white">
      <v-tabs
        v-model="tab"
        fixed-tabs
        class="text-center mb-4"
        slider-color="red"
      >
        <v-tab :value="register">
          <Icon :name="Icons.REGISTER" />
          新規登録
        </v-tab>
        <v-tab :value="login">
          <Icon :name="Icons.LOGIN" />
          ログイン
        </v-tab>
      </v-tabs>
      <v-window v-model="tab">
        <v-window-item :value="register">
          <v-row>
            <v-col>
              <v-btn
                variant="outlined"
                rounded="0"
                class="relative d-block mx-auto border-2 border-indigo-500 w-[250px]"
              >
                <v-img
                  contain
                  src="../../assets/images/google.png"
                  class="mr-auto absolute"
                  max-width="20"
                />
                Googleで登録
              </v-btn>
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <v-btn
                variant="outlined"
                rounded="0"
                class="d-block mx-auto border-2 border-indigo-500 w-[250px]"
              >
                <v-img
                  contain
                  src="../../assets/images/twitter.png"
                  class="mr-auto"
                  max-width="20"
                />
                Twitterで登録
              </v-btn>
            </v-col>
          </v-row>
          <div class="supplement text-center my-4">
            <p class="d-inline bg-white">またはメールアドレスで登録</p>
          </div>
          <Form>
            <div class="text-caption">
              <span class="text-red">※</span>は必須項目です
            </div>
            <slot name="form-card-content" />
            <Btn
              btnValue="登録"
              place="MAIN"
              width="16rem"
              setColor="orange"
              class="mt-4 d-block"
            />
          </Form>
        </v-window-item>
        <v-window-item :value="login">
          <h2>test</h2>
        </v-window-item>
      </v-window>
    </v-container>
  </div>
</template>
<script setup lang="ts">
import { Icons } from "@/constants/icons";
import { Form } from "vee-validate";
import * as Yup from "yup";
import { ref } from "vue";

const tab = ref(null);
</script>

<style setup lang="scss">
.supplement {
  position: relative;
  z-index: 0;

  &::before {
    content: "";
    display: block;
    width: 100%;
    height: 2px;
    background-image: linear-gradient(
      to right,
      #000,
      #000 3px,
      transparent 3px,
      transparent 8px
    );
    background-size: 8px 1px;
    background-repeat: repeat-x;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: -1;
  }
}
</style>
