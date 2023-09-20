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
    encrypted: true,
    forceTLS:false,
    authorizer: (channel, options) => {
      return {
          authorize: async(socketId, callback) => {
              await useApiFetch('/api/broadcasting/auth', {
                method: "POST",
                body: {
                  socket_id: socketId,
                  channel_name: channel.name
              }})
              .then(response => {
                console.log(response)
                  callback(false, response.data);
              })
              .catch(error => {
                  callback(true, error);
              });
          }
      };
  },
  })
})
