import { defineStore } from "pinia";
import { useRuntimeConfig } from "#imports";
const config = useRuntimeConfig();

export const useProfileStore = defineStore({
  id: "profile",

  state: () => ({
    prof: {
      pathHeader: "",
      pathThumbnail: "",
      userId: "",
      headerImg: "",
      thumbnail: "",
      introduction: "",
      itemId: "",
      urlHeaderImg: config.public.appURL + "/images/noimage.jpg",
      urlThumbnail: config.public.appURL + "/images/noimage.jpg",
    },
  }),

  getters: {
    getProf: (state) => state.prof,
  },
  actions: {
    async fetchProfile(authId) {
      const { data } = await useApiFetch(`/api/profile/${authId}`);

      if(data) {
        const items = data.value.profile;
        this.prof.urlHeaderImg = config.public.baseURL +'/storage/'+ items.header_img_path;
        this.prof.urlThumbnail = config.public.baseURL +'/storage/' + items.thumbnail_path;
        this.prof.introduction = items.introduction;
        this.prof.itemId = items.id;
      }
    },
    setValue(val){
      console.log('test',val);
        if(val.val && val.target == "header") {
          this.prof.pathHeader = val.val;
          this.prof.urlHeaderImg = URL.createObjectURL(val.val);
        }
        if(val.val && val.target == "thumbnail"){
          this.prof.pathThumbnail = val.val;
            this.prof.urlThumbnail = URL.createObjectURL(val.val);
        }

        if(val.value) this.prof.introduction = val.value;
        if(val.item_id) this.prof.itemId = val.item_id;
        if(val.path_header) this.prof.pathHeader = val.path_header;
        if(val.path_thumbnail)this.prof.pathThumbnail = val.path_thumbnail;
        if(val.introduction)  this.prof.introduction = val.introduction;
    }
  },
});
