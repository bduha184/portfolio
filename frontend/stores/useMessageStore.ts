import { defineStore } from "pinia";
import { useApiFetch } from "../composables/useApiFetch";
import { computed } from "vue";
import { useRuntimeConfig } from "nuxt/app";

const config = useRuntimeConfig();

export const useMessageStore = defineStore( "message",{
    state: () => ({
      messages: [],
      message: "",
    }),
    getters: {
      getMessages:(state)=>state.messages,
      getMessage: (state) => state.message,
    },
    actions: {
      async fetchMessages() {
        const res = await useApiFetch("/api/message/");
        const messages = res.data.value;
        this.messages.push(...messages);
      },

      // async fetchRecruitItem(id) {
      //   const res = await useApiFetch(`/api/recruit/${id}`);
      //   // console.log(res);
      //   // this.id = res.data.value.data.id;
      //   this.url_header_img = config.public.baseURL + '/storage/'+ res.data.value.data.header_img_path;
      //   this.url_thumbnail= config.public.baseURL + '/storage/'+ res.data.value.data.thumbnail_path;
      //   this.title = res.data.value.data.title;
      //   this.text = res.data.value.data.text;
      // },

      async registerMessage(data) {
        await useApiFetch("/sanctum/csrf-cookie");
        const res = await useApiFetch("/api/message/register", {
          method: "POST",
          body: data,
        });

        console.log(res);
        // this.id = res.data.value.;

      },
    },
  });
