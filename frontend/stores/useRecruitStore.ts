import { defineStore } from "pinia";
import { useApiFetch } from "../composables/useApiFetch";
import { computed } from "vue";

type User = {
  id: number;
  name: string;
  email: string;
};

export const useRecruitStore = defineStore("recruit", {
  state: () => ({
    items:[],
    item:'',
    path_header: "",
    path_thumbnail: "",
    id:"",
  }),
  getters: {
    getRecruitItem: (state) => state.item,
  },
  actions: {

    async fetchRecruitItems() {
      const res = await useApiFetch("/api/recruit/");
      const recruitItems = res.data.value;
      this.items.push(...recruitItems);
    },

    async fetchRecruitItem() {
      const res = await useApiFetch(`/api/recruit/${this.id}`);
      const recruitItem = res.data.value;

      console.log(this.id);
      console.log(recruitItem);
      // this.item = recruitItem;
    },

    async registerRecruitItem(data){

      await useApiFetch("/sanctum/csrf-cookie");
      const res = await useApiFetch("/api/recruit/register",{
        method:"POST",
        body:data,
      });
      this.id = res.data.value.id;
      this.path_header = res.data.value.path_header;
      this.path_thumbnail = res.data.value.path_thumbnail;
    },
  },
});
