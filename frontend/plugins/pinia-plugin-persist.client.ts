// import { Context } from '@nuxt/types'
// import piniaPersist from 'pinia-plugin-persist'

// export default ({ app }: Context) => {
//   app.pinia?.use(piniaPersist)
// }
import { useAuthStore } from "../stores/useAuthStore";

export default defineNuxtPlugin(async (nuxtApp)=> {
  // const auth = useAuthStore();

  // if(!auth.isLoggedIn) {
  //   await auth.fetchUser();
  // }
})
