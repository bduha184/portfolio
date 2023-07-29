<template>
  <div>
    <ButtonSns />
    <div
      class="text-center my-4 relative before:absolute before:left-0 before:top-50 before:h-[1px] before:w-full before:bg-slate-600 z-0"
    >
      or
    </div>
    <Form>
      <div class="text-caption">
        <span class="text-red">※</span>は必須項目です
      </div>
      <UserFormEmail />
      <UserFormName />
      <UserFormPassword />
      <UserFormPasswordConfirm />
      <UserFormConsent />
      <ButtonCommon
        btnValue="登録"
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
