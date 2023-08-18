import { defineStore } from "pinia";
import { useApiFetch } from "../composables/useApiFetch";
import { computed } from "vue";
import { useRuntimeConfig } from "nuxt/app";

const config = useRuntimeConfig();

export const useRecruitStore = defineStore( "recruit",{
    state: () => ({
      items: [],
      item: "",
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
      },

      async fetchRecruitItem(itemId) {
        const res = await useApiFetch(`/api/recruit/${itemId}`);
        this.item = res.data.value;
      },

      async registerRecruitItem(data) {
        await useApiFetch("/sanctum/csrf-cookie");
        const res = await useApiFetch("/api/recruit/register", {
          method: "POST",
          body: data,
        });

        this.path_header = res.data.value.path_header;
        this.path_thumbnail = res.data.value.path_thumbnail;
      },
    },
  });
