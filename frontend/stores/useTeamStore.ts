import { defineStore } from "pinia";
import type {Props} from "~/types";

export const useTeamStore = defineStore({
  id: "team",

  state: () => ({
    teams: [],
    tab:'',
    page:0,
    loading:false,
  }),

  getters: {
    getPage: (state) => state.page,
    getLoading: (state) => state.loading,
    getTeams: (state) => state.teams,
    getTeamCount: (state) => state.teams.length,
  },
  actions: {
    async fetchAllTeams() {

      this.loading = true;
      const {data,error} = await useApiFetch("/api/team",{
        method: "POST",
        body: {
          page: this.page,
        },
        headers: {
          "X-HTTP-Method-Override": "GET",
        },
      });
      this.loading = false;
      console.log('fetchall',data);
      const teams = data.value.teams;
      if (error.value == null && teams) {
        teams.forEach((team) => {
          this.teams.push(team);
        });
      }
      this.page++;
    },
    async fetchTeams(keywords: Array<string | number>,multi:boolean) {
      const res = await useApiFetch("/api/team/search", {
        method: "POST",
        body: {
          keywords: keywords,
          tab:this.tab,
          multi:multi,
          page:this.page
        },
        headers: {
          "X-HTTP-Method-Override": "GET",
        },
      });
      console.log(res);
      const teams = res.data.value.teams;
      if (res.error.value == null && teams) {
        teams.forEach((team) => {
          this.teams.push(team);
        });
      }
       this.page++;
    },
    async fetchAffiliationTeams(){
      const res = await useApiFetch("/api/team/auth");
      const teams = res.data.value.affiliations;
      if (res.error.value == null && teams) {
        teams.forEach((team) => {
          this.teams.push(team);
        });
      }
    },
    setTab(tab:string){
      this.tab = tab;
    },
     setPageInitialize(){
      this.page = 0;
      this.teams.length = 0;
    },
  },
});
