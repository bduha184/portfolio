import { useAuthStore } from "../stores/useAuthStore";
import { navigateTo } from "#imports";
import {onMounted} from 'vue';
import {Url} from '../constants/url';

export default defineNuxtPlugin(async (nuxtApp)=> {
  const auth = useAuthStore();

  onMounted(async()=>{
    const res = await auth.fetchUser();
    console.log(res);
    if(res==null){
      return navigateTo(Url.SIGNIN);
    }
  })
})
