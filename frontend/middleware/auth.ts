import { useAuthStore } from "../stores/useAuthStore"

export default defineNuxtRouteMiddleware(async(to,from)=> {
  const auth = useAuthStore();

  if (!auth.isLoggedIn) {
    return navigateTo("/beforeLogin", {replace: true});
  }
})
