import { defineStore } from "pinia";
export const useFlashMessageStore = defineStore({
  id:"flashMessage",

  state: ()=>({
    message: "",
    status: false,
    color: '',
  }),

  getters : {
     getMessage:(state) => state.message,
     getStatus:(state) => state.status,
     getColor:(state) => state.color,
  },

  actions : {
    setMessage(message,color='success',timeout=2000){
      this.message = message;
      this.color = color;
      this.status = true;
      this.hiddenMessage(timeout);
    },
    hiddenMessage(timeout){
      setTimeout(()=>{
        this.status = false;
      },timeout)
    }
  },

});
