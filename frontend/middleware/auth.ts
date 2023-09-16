import { useAuthStore } from "../stores/useAuthStore"
import {Url} from "../constants/url";

export default defineNuxtRouteMiddleware(async(to,from)=> {
  const auth = useAuthStore();

  const res = await auth.fetchUser();
  if(res==null){
    return navigateTo(Url.SIGNIN);
  }

})
