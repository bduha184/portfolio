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
  email: string;
};

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
  provider: string;
};

type RedirectParams = {
  authuser: number;
  code: string;
  Prompt: string;
  scope: string;
  State: string;
};

type SnsRegister = {
  name: string;
  email: string;
  provider: string;
  token: string;
};

type ResetPassword = {
  token: any;
  email: string;
  password: string;
  password_confirmation: string;
};

export const useAuthStore = defineStore("auth", {
  state: () => ({
    user:"",
  }),
  getters: {},
  actions: {},
});
