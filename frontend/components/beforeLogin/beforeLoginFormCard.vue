<template>
  <div class="p-4">
    <v-container class="bg-white">
      <v-row class="text-center">
        <v-col>
          <Icon :name="HOME" />
          <v-list-item-title class="mt-4"> 新規登録 </v-list-item-title>
        </v-col>
        <v-col
          ><Icon :name="HOME" />
          <v-list-item-title class="mt-4">
            ログイン
          </v-list-item-title></v-col
        >
      </v-row>

      <div class="text-center">
        <v-btn variant="outlined" rounded="0" class="border-2 border-indigo-500">
          <v-icon :icon="Icons.HOME" />
          Googleで登録
        </v-btn>
      </div>
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
          class="mt-4 d-sm-block"
        />
      </Form>
    </v-container>
  </div>
</template>
<script setup lang="ts">
import { Icons } from "@/constants/icons";
import { Form } from "vee-validate";
import * as Yup from "yup";
</script>

<style setup lang="scss">

.supplement{
  position: relative;
  z-index: 0;

  &::before{
    content: "";
    display: block;
    width: 100%;
    height: 2px;
    background-image: linear-gradient(to right,#000,#000 3px,transparent 3px,transparent 8px);
    background-size: 8px 1px;
    background-repeat: repeat-x;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
  z-index: -1;
  }
}

</style>
