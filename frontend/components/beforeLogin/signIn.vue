<template>
  <div>
    <ButtonSns />
    <div class="supplement text-center my-4">or</div>
    <Form>
      <div class="text-caption">
        <span class="text-red">※</span>は必須項目です
      </div>
      <UserFormName />
      <UserFormPassword />
      <ButtonCommon
        btnValue="ログイン"
        place="MAIN"
        width="16rem"
        setColor="orange"
        class="my-4 d-block"
      />
    </Form>
  </div>
</template>

<script setup lang="ts">
import { Form } from "vee-validate";
import * as Yup from "yup";
</script>

<style scoped lang="scss"></style>
