import { defineStore } from "pinia";

type Keywords = {
  keywords:Array<String | Number>
};

export const useTeamStore = defineStore({
  id:"team",

  state: ()=>({
    teams: [],
  }),

  getters : {
     getTeams:(state) => state.teams,
  },
  actions : {
    async fetchTeams(keywords:Keywords){
      this.teams.length = 0;
      console.log(keywords);
      const res = await useApiFetch('/api/team/search',{
        method: "POST",
        body: {
          keywords:keywords
        },
        headers: {
          "X-HTTP-Method-Override": "GET",
        },
      });
      console.log(res);
      // const teams = res.data.value.teams;
      // if(res.error.value == null && teams){
      //   teams.forEach(team => {
      //     console.log(team);
      //   });
      // }
    }
    },
}
);
