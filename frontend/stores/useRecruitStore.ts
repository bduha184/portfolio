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
    title: "",
    text: "",
    path_header: "",
    path_thumbnail: "",
  }),
  // getters: {
  //   getRecruit: (state) => state.articles,
  // },
  actions: {
    async getMasterRecruit() {
      await useApiFetch("/sanctum/csrf-cookie");
      const res = await useApiFetch(`/api/recruit/${}`, {
        method: "POST",
        body: formData,
      });

      this.$state.path_header = res.data.value.path_header;
      this.$state.path_thumbnail = res.data.value.path_thumbnail;
    },
  },
});
