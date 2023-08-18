import { defineStore } from "pinia";

export const usePrefecturesStore = defineStore(
  "prefectures",
  () => {

    async function fetchPrefectures() {
      const { data } = await useFetch("https://opendata.resas-portal.go.jp/api/v1/prefectures",{
      });

      return data;
    }
    return { fetchPrefectures};
  },
  {
    persist: {
      storage: persistedState.sessionStorage,
    },
  }
);
