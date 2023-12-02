import { defineStore } from "pinia";

export const useTeamStore = defineStore({
  id: "team",

  state: () => ({
    teams: [],
    tab:'',
  }),

  getters: {
    getTeams: (state) => state.teams,
    getTeamCount: (state) => state.teams.length,
  },
  actions: {
    async fetchAllTeams(page:number) {
      const res = await useApiFetch("/api/team",{
        method: "POST",
        body: {
          page: page,
        },
        headers: {
          "X-HTTP-Method-Override": "GET",
        },
      });
      const teams = res.data.value.teams;
      if (res.error.value == null && teams) {
        teams.forEach((team) => {
          this.teams.push(team);
        });
      }
    },
    async fetchTeams(keywords: Array<string | number>,multi:boolean) {
      console.log(keywords);
      const res = await useApiFetch("/api/team/search", {
        method: "POST",
        body: {
          keywords: keywords,
          tab:this.tab,
          multi:multi
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
  },
});
