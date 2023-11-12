import { defineStore } from "pinia";
import { useRuntimeConfig } from "nuxt/app";
const config = useRuntimeConfig();
export const useGalleryStore = defineStore({
  id:"gallery",

  state: ()=>({
    images: [],
    postImages:[],
    displayImages:[],
    targetImage:'',
  }),

  getters : {
     getImages:(state) => state.images,
     getPostImages:(state) => state.postImages,
     getDisplayImages:(state) => state.displayImages,
     getTargetImage:(state) => state.targetImage
  },

  actions : {
    setImages(images){
      Array.from(images).forEach(image => {
        this.postImages.push(image);
        let imageUrl = URL.createObjectURL(image);
        this.displayImages.push(imageUrl);
      })
    },
    deleteImages(target){
      this.displayImages.splice(target,1);
      this.postImages.splice(target,1);
    },
    revokeImages(){
      this.displayImages.forEach(image=>{
        URL.revokeObjectURL(image);
      })
    },
    selectImage(target){
      this.targetImage = target;
    },
    async fetchGalleryImages(userId){
      this.images.length = 0;
      const res = await useApiFetch(`/api/image/${userId}`);

      const images = res.data.value.images;
      if(res.error.value == null && images){
        images.forEach(image => {
          this.images.push(config.public.baseURL +'/storage/'+ image);
        });
      }
    }
    },
}
);
