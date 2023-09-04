import { useAuthStore } from "../stores/useAuthStore"
import {Url} from "../constants/url";

export default defineNuxtRouteMiddleware(async(to,from)=> {
  const auth = useAuthStore();

  if (!auth.isLoggedIn) {
    return navigateTo(Url.SIGNUP);
  }
})
