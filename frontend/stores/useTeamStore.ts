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
    async fetchAllTeams() {
      this.teams.length = 0;
      const res = await useApiFetch("/api/team");
      const teams = res.data.value.teams;
      if (res.error.value == null && teams) {
        teams.forEach((team) => {
          this.teams.push(team);
        });
      }
    },
    async fetchTeams(keywords: Array<string | number>) {
      this.teams.length = 0;
      console.log(keywords);
      const res = await useApiFetch("/api/team/search", {
        method: "POST",
        body: {
          keywords: keywords,
          tab:this.tab
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
    setTab(tab:string){
      this.tab = tab;
    },
  },
});
