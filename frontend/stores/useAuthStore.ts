import { defineStore } from "pinia";
import { useApiFetch } from "../composables/useApiFetch";
import { computed } from "vue";
import { RefSymbol } from "@vue/reactivity";

type User = {
  id: number;
  name: string;
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

export const useAuthStore = defineStore(
  "auth",
  () => {
    const user = ref<User | null>(null);
    const isLoggedIn = computed(() => user.value !== null);

    async function fetchUser() {
      const { data } = await useApiFetch("/api/user");
      user.value = data.value as User;
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
    return { user, login, logout, isLoggedIn, fetchUser, register };
  },
  // {
  //   persist: {
  //     storage: persistedState.sessionStorage,
  //   },
  // }
);
