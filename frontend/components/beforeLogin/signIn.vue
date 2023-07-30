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
        @click="onSubmit()"
      />
    </Form>
    {{ data }}
  </div>
</template>

<script setup lang="ts">
import { Form } from "vee-validate";
import * as Yup from "yup";

import {ref} from 'vue';

const data = ref(null);

const onSubmit = async ()  => {
  const res = await useFetch('http://localhost:8000/api/test');

    data.value = res;
}

</script>

<style scoped lang="scss"></style>
