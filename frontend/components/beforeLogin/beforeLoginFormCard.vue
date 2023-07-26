<template>
  <div class="p-4">
    <v-container class="bg-white">
      <v-list class="d-flex justify-between text-center border-b-2">
        <v-list-item :class="select ? 'border-indigo-500' : ' '">
          <Icon :name="HOME" />
          <v-list-item-title class="d-block"> 新規登録 </v-list-item-title>
        </v-list-item>
        <v-list-item>
          <Icon :name="HOME" />
          <v-list-item-title align="center" class="d-block">
            ログイン
          </v-list-item-title>
        </v-list-item>
      </v-list>
      <div class="text-center">
        <v-btn class="d-block">
          <v-icon :icon="Icons.HOME" />
          Googleで登録
        </v-btn>
      </div>
      <Form>
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
import { Form } from 'vee-validate'
import * as Yup from "yup"

</script>
