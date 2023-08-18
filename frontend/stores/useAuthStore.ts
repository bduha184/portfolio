import { defineStore } from "pinia";
import { useApiFetch } from "../composables/useApiFetch";
import { computed } from "vue";
import { RefSymbol } from "@vue/reactivity";

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
      const { data } = await useApiFetch("/api/user");
      user.value = data.value as User;

      return data
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
      navigateTo("/beforeLogin");
    }

    async function login(credentials: Credentials) {
      await useApiFetch("/sanctum/csrf-cookie");

      const login = await useApiFetch("/api/login", {
        method: "POST",
        body: credentials,
      });

      await fetchUser();

      return login;
    }

    async function register(info: RegistrationInfo) {
      console.log(info);
      await useApiFetch("/sanctum/csrf-cookie");

      const register = await useApiFetch("/api/register", {
        method: "POST",
        body: info,
      });
      await fetchUser();
      return register;
    }
    async function providerLogin(provider:Provider){
      await useApiFetch("/sanctum/csrf-cookie");

      const providerLogin = await useApiFetch(`/api/login/${provider}`);
      return providerLogin;
    }

    async function providerLoginRedirect(provider:Provider,params:RedirectParams){
      await useApiFetch("/sanctum/csrf-cookie");

      const providerLoginRedirect = await useApiFetch(`/api/login/${provider}/callback`,{
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
        body:email
      })

      await fetchUser();
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
    return { user,guestLogin, login, logout, isLoggedIn, fetchUser, register ,providerLogin,providerRegister,providerLoginRedirect,forgotPassword,resetPassword};

  },
  {
    persist: {
      storage: persistedState.sessionStorage,
    },
  }
);
