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
    }
  },
  persist: true
}
);
