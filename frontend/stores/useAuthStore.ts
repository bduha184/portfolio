import { defineStore } from "pinia";
import {Url} from '~/constants/url';


type User = {
  id: number;
  name: string;
  email: string;
};

type Email = {
  email:string
}

type Credentials = {
  email: string;
  password: string;
};
type RegistrationInfo = {
  name: string;
  email: string;
  password: string;
  password_confirmation: string;
};

type Provider = {
  provider:string
}

type RedirectParams = {
  authuser: number;
  code:string;
  Prompt:string;
  scope:string;
  State:string;
}


type SnsRegister = {
  name:string,
  email:string,
  provider:string,
  token:string
}

type ResetPassword = {
  token:any,
  email:string,
  password:string,
  password_confirmation:string,
}

export const useAuthStore = defineStore(
"auth",
  () => {
    const user = ref<User | null>(null);
    const isLoggedIn = computed(() => user.value !== null);

    async function fetchUser() {
      const res = await useApiFetch("/api/user");
      console.log(res);
      if(res.error.value == null){
        user.value = res.data.value?.user as User;
      }

      return user.value;
    }

    async function guestLogin(){
      await useApiFetch("/sanctum/csrf-cookie");

      const guestLogin = await useApiFetch("/api/login/guestlogin",{
        method:"POST"
      });
      await fetchUser();

      return guestLogin;
    }

    async function logout() {
      await useApiFetch("/api/logout", { method: "POST" });
      user.value = null;
      return navigateTo({
        path:Url.SIGNIN,
        query:{
          tab:'login'
        }
      });
    }

    async function login(credentials: Credentials) {
      await useApiFetch("/sanctum/csrf-cookie");

      const login = await useApiFetch("/api/login", {
        method: "POST",
        body: credentials,
      });
      console.log(login);
      user.value = login.data.value?.user;

      // await fetchUser();

      return login;
    }

    async function register(info: RegistrationInfo) {
      await useApiFetch("/sanctum/csrf-cookie");

      const data = await useApiFetch("/api/register", {
        method: "POST",
        body: info,
      });
      await fetchUser();
      return data;
    }
    async function providerLogin(provider:Provider){
      await useApiFetch("/sanctum/csrf-cookie");

      const providerLogin = await useApiFetch(`/api/login/${provider}`);
      return providerLogin;
    }

    async function providerLoginRedirect(params:RedirectParams){
      await useApiFetch("/sanctum/csrf-cookie");

      const providerLoginRedirect = await useApiFetch(`/api/login/${params.provider}/callback`,{
        method:'POST',
        body:params
      });
      await fetchUser();
      return providerLoginRedirect;
    }

    async function providerRegister(snsRegister:SnsRegister){
      await useApiFetch("/sanctum/csrf-cookie");

      const providerRegister = await useApiFetch(`/api/register/${snsRegister.provider}`, {
        method: "POST",
        body:snsRegister
      });
      await fetchUser();
      return providerRegister;
    }


    async function forgotPassword(email:Email){
      await useApiFetch("/sanctum/csrf-cookie");
      const forgotPassword = await useApiFetch('/forgot-password',{
        method:'POST',
        body:{email:email}
      })

      return forgotPassword;
    }

    async function resetPassword(token:ResetPassword,email:ResetPassword,password:ResetPassword,password_confirmation:ResetPassword){

      await useApiFetch("/sanctum/csrf-cookie");

      const resetPassword = await useApiFetch('/reset-password',{
        method:'POST',
        body:{
          token,
          email,
          password,
          password_confirmation
        }
      })

      await fetchUser();
      return resetPassword;
    }

    async function deleteUser() {
      await useApiFetch("/sanctum/csrf-cookie");

      const userId = user.value?.id;
      const deleteUser = await useApiFetch(`/api/user/${userId}`,{
        method:'DELETE',
        body:{
          userId,
        },
      })
      user.value = null;

      return deleteUser;
    }

    return { user,guestLogin, login, logout, isLoggedIn, fetchUser, register ,providerLogin,providerRegister,providerLoginRedirect,forgotPassword,resetPassword,deleteUser};
  },
  {
    persist: true,
  }
);
