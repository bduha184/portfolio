import { defineStore } from "pinia";
import { useApiFetch } from "../composables/useApiFetch";
import { useRuntimeConfig } from "nuxt/app";

const config = useRuntimeConfig();

export const useProfileStore = defineStore( "profile",{
    state: () => ({
      items: [],
      item: "",
      itemCount:0,
      path_header: "",
      path_thumbnail: "",
      item_id: 0,
      user_id:0,
      header_img: "",
      thumbnail: "",
      text: "",
      url_header_img: config.public.appURL + "/images/noimage.jpg",
      url_thumbnail: config.public.appURL + "/images/noimage.jpg",
    }),
    getters: {
      getProfileItemCount:(state)=>state.itemCount,
      getProfileItems: (state) => state.items,
      getProfileItem: (state) => state.item,
      getProfilePathHeader: (state) => state.path_header,
      getProfilePathThumbnail: (state) => state.thumbnail,
      getProfileItemId: (state) => state.item_id,
      getProfileUserId: (state) => state.user_id,
      getProfileHeaderImg: (state) => state.header_img,
      getProfileThumbnail: (state) => state.thumbnail,
      getProfileText: (state) => state.text,
      getProfileHeaderUrl: (state) => state.url_header_img,
      getProfileThumbnailUrl: (state) => state.url_thumbnail,
    },
    actions: {
      async fetchProfileItems() {
        // const res = await useApiFetch("/api/profile/");
        // const ProfileItems = res.data.value;
        // this.items.push(...ProfileItems);
        // this.itemCount = res.data.value.length;
      },

      async fetchProfileItem(id) {
        const res = await useApiFetch(`/api/profile/${id}`);
        // console.log(res);
        const val = res.data.value;
        this.item_id = val.data.id;
        this.url_header_img = config.public.baseURL + '/storage/'+ val.data.header_img_path;
        this.url_thumbnail= config.public.baseURL + '/storage/'+ val.data.thumbnail_path;
        this.text = val.data.text;
        this.user_id = val.data.user_id;
      },

      async registerProfileItem(data) {
        // console.log(...data.entries());
        await useApiFetch("/sanctum/csrf-cookie");
        const res = await useApiFetch("/api/profile/register", {
          method: "POST",
          body: data,
        });

        console.log(res);
        this.item_id = res.data.value.itemId;
        this.path_header = res.data.value.path_header;
        this.path_thumbnail = res.data.value.path_thumbnail;

      },
      async updateProfileItem(data,itemId) {
        // console.log(...data.entries());
        // console.log(itemId);
        await useApiFetch("/sanctum/csrf-cookie");
        const res = await useApiFetch(`/api/profile/${itemId}`, {
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
      async deleteProfileItem(id) {
        await useApiFetch("/sanctum/csrf-cookie");
        const res = await useApiFetch(`/api/profile/${id}`,{
          method:'DELETE'
        })

        console.log(res);
      }
    },
  });
