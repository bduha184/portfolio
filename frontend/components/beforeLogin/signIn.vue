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

<script setup>
import { Form } from "vee-validate";
import * as Yup from "yup";
import { ref } from "vue";

const config = useRuntimeConfig();

const data = ref(null);
const onSubmit = async () => {
  await useFetch('/sanctum/csrf-cookie', {
    method: "get",
    baseURL: config.baseURL,
    mode: "cors",
    headers: {
      "X-Requested-With": "XMLHttpRequest",
      "Content-Type": "application/json",
    },
    credentials: "include",
  }).then(async (res) => {
    await useFetch("localhost:8000/api/users").then((res) => {
      data.value = res;
    });
  });
};
</script>

<style scoped lang="scss"></style>
