import { defineStore } from "pinia";
export const useGalleryStore = defineStore({
  id:"gallery",

  state: ()=>({
    images: [],
    displayImages:[]
  }),

  getters : {
     getImages:(state) => state.images,
     getDisplayImages:(state) => state.displayImages,
  },

  actions : {
    setImages(images){
      Array.from(images).map(image=>{
        this.images.push(image);
        const imageUrl = window.URL.createObjectURL(image);
        this.displayImages.push(imageUrl);
      })
    },
    deleteImages(target){
      this.displayImages.splice(target,1);
      this.images.splice(target,1);
    }
  },
  persist:true,
}
);
