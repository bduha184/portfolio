<template>
  <div>
    <ButtonSns />
    <div class="supplement text-center my-4">or</div>
    <Form>
      <div class="text-caption">
        <span class="text-red">※</span>は必須項目です
      </div>
      <UserFormName @setName="receiveName" :name="name"/>
      <UserFormPassword @setPass="receivePass" :name="pass"/>
      <ButtonCommon
        btnValue="ログイン"
        place="MAIN"
        width="16rem"
        setColor="orange"
        class="my-4 d-block"
        @click="onSubmit(data.name)"
      />
    </Form>
    {{ data.name }}
    {{ data.pass}}
    {{ data.loggedIn }}

    <!-- {{ test }} -->
  </div>
</template>

<script setup>
import { Form } from "vee-validate";
import * as Yup from "yup";
import { ref,reactive } from "vue";

const config = useRuntimeConfig();

const data = reactive({
  name:String,
  pass:String,
  loggedIn:String,
  url:String,
});

data.url = config.public.baseURL;

const receiveName = (setName) => {
  data.name = setName;
}
const receivePass = (setPass) => {
  data.pass = setPass;
}



const onSubmit = async (name) => {

  // await useFetch(config.public.baseURL+'/sanctum/csrf-cookie',{
  //   credentials: 'include',
  // }).then(async(res) => {
    await useFetch(config.public.baseURL+'/api/login',{
      method:'post',
      body:name
  }).then(async(res)=>{
    data.loggedIn = res;
    console.log(res);
  })
// })
};



</script>

<style scoped lang="scss"></style>
