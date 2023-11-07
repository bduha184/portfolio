import { defineStore } from "pinia";
export const useGalleryStore = defineStore({
  id:"gallery",

  state: ()=>({
    images: [],
    postImages:[],
    displayImages:[]
  }),

  getters : {
     getImages:(state) => state.images,
     getPostImages:(state) => state.postImages,
     getDisplayImages:(state) => state.displayImages,
  },

  actions : {
    setImages(images){
      Array.from(images).map(image=>{
        this.postImages.push(image);
        const imageUrl = URL.createObjectURL(image);
        this.displayImages.push(imageUrl);
      })
    },
    deleteImages(target){
      this.displayImages.splice(target,1);
      this.images.splice(target,1);
    },
  },
  persist: true
}
);
