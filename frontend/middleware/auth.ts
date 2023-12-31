import { useAuthStore } from "../stores/useAuthStore"
import {Url} from "../constants/url";

export default defineNuxtRouteMiddleware(async()=> {
  const auth = useAuthStore();

  const res = await auth.fetchUser();
  console.log(res);
  if(res==null){
    return navigateTo({
      path:Url.SIGNIN,
      query:{
        tab:'login'
      }
    });
  }
})
