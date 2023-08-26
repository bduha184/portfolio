import { defineStore } from "pinia";
import { useApiFetch } from "../composables/useApiFetch";
import { computed } from "vue";
import { useRuntimeConfig } from "nuxt/app";

const config = useRuntimeConfig();

export const useRecruitStore = defineStore( "recruit",{
    state: () => ({
      items: [],
      item: "",
      itemCount:0,
      path_header: "",
      path_thumbnail: "",
      id: "",
      header_img: "",
      thumbnail: "",
      title: "",
      text: "",
      url_header_img: config.public.appURL + "/images/noimage.jpg",
      url_thumbnail: config.public.appURL + "/images/noimage.jpg",
    }),
    getters: {
      getRecruitItemCount:(state)=>state.itemCount,
      getRecruitItems: (state) => state.items,
      getRecruitItem: (state) => state.item,
      getRecruitPathHeader: (state) => state.path_header,
      getRecruitPathThumbnail: (state) => state.thumbnail,
      getRecruitItemId: (state) => state.id,
      getRecruitHeaderImg: (state) => state.header_img,
      getRecruitThumbnail: (state) => state.thumbnail,
      getRecruitTitle: (state) => state.title,
      getRecruitText: (state) => state.text,
      getRecruitHeaderUrl: (state) => state.url_header_img,
      getRecruitThumbnailUrl: (state) => state.url_thumbnail,
    },
    actions: {
      async fetchRecruitItems() {
        const res = await useApiFetch("/api/recruit/");
        const recruitItems = res.data.value;
        this.items.push(...recruitItems);
        this.itemCount = res.data.value.length;
        console.log(res);
      },

      async fetchRecruitItem(userId) {
        const res = await useApiFetch(`/api/recruit/${userId}`);
        console.log(res);
        this.id = res.data.value.data.id;
        this.url_header_img = config.public.baseURL + '/storage/'+ res.data.value.data.header_img_path;
        this.url_thumbnail= config.public.baseURL + '/storage/'+ res.data.value.data.thumbnail_path;
        this.title = res.data.value.data.title;
        this.text = res.data.value.data.text;
      },

      async registerRecruitItem(data) {
        // console.log(...data.entries());
        await useApiFetch("/sanctum/csrf-cookie");
        const res = await useApiFetch("/api/recruit/register", {
          method: "POST",
          body: data,
        });
        console.log(res.data.value);

        this.path_header = res.data.value.path_header;
        this.path_thumbnail = res.data.value.path_thumbnail;
      },
      async updateRecruitItem(data,itemId) {
        console.log(...data.entries());
        console.log(itemId);
        await useApiFetch("/sanctum/csrf-cookie");
        const res = await useApiFetch(`/api/recruit/${itemId}`, {
          method: "POST",
          body: data,
          headers:{
            'X-HTTP-Method-Override' : 'PUT'
          }
        });

        // console.log(res.data.value);

        this.path_header = res.data.value.path_header;
        this.path_thumbnail = res.data.value.path_thumbnail;
      },
      async deleteRecruitItem(id) {
        await useApiFetch("/sanctum/csrf-cookie");
        const res = await useApiFetch(`/api/recruit/${id}`,{
          method:'DELETE'
        })

        console.log(res);
      }
    },
  });
