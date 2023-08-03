import {defineStore} from "pinia";
import { useApiFetch } from "../composables/useApiFetch";

type User = {
  id:number,
  name:string,
  email:string
}

type Credentials = {
  name:string,
  pass:string

}

export const useAuthStore = defineStore('auth', () => {

  const user = ref<User | null>(null)

  async function login(credentials:Credentials) {
    await useApiFetch("/sanctum/csrf-cookie");

    const login = await useApiFetch("/api/login",{
      method:'POST',
      body:credentials
    });

    const {data} = await useApiFetch("/api/user");

    user.value = data.value as User;

    return login;
  }

  return {user,login};
})
