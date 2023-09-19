import Echo from 'laravel-echo'
import Pusher from 'pusher-js';

declare global {
  interface Window {
    Pusher:any;
    Echo:any;
  }
}

export default defineNuxtPlugin(() => {
  window.Pusher = Pusher
  window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    // authorizer: (channel, options) => {
    //   return {
    //     authorize: async (socketId, callback) => {
    //       try {
    //         const response = await useApiFetch('api/broadcasting/auth', {
    //           method: "POST",
    //           body: {
    //             socket_id: socketId,
    //             channel_name: channel.name
    //         }})

    //         callback(null, response)
    //       } catch (error) {
    //         callback(error)
    //       }
    //     }
    //   };
    // },
  })
})
