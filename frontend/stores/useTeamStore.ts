import { defineStore } from "pinia";
import type {Props} from "~/types";
import { useRuntimeConfig } from "#imports";

const config = useRuntimeConfig();
export const useTeamStore = defineStore({
  id: "team",

  state: () => ({
    teams: [],
    tab:'',
    page:0,
    loading:false,
    details:{
      pathHeader: "",
      pathThumbnail: "",
      itemId: "",
      userId: "",
      headerImg: "",
      thumbnail: "",
      teamName: "",
      average: "",
      fromAge: "",
      toAge: "",
      rides: [],
      areas: [],
      detailAreas: "",
      introduction: "",
      memberCount: 0,
      detailActivities: "",
      schedule: "",
      activeDate: [],
      activeDateDetail: "",
      teamUrl: "",
      urlHeaderImg: config.public.appURL + "/images/noimage.jpg",
      urlThumbnail: config.public.appURL + "/images/noimage.jpg",
    }
  }),

  getters: {
    getPage: (state) => state.page,
    getLoading: (state) => state.loading,
    getTeams: (state) => state.teams,
    getTeamCount: (state) => state.teams.length,
    getTeamDetail:(state) => state.details
  },
  actions: {
    async fetchMyTeams() {
      const {data} = await useApiFetch("/api/team/myteam");
console.log(data);
      if(data.value != null){
        this.setTeamValue(data.value.team_info);
      }
    },
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
    setTeamValue(val){
      console.log(val);
      this.details.itemId = val.id;
      this.details.urlHeaderImg = config.public.baseURL + "/storage/" + val.header_img_path;
      this.details.urlThumbnail = config.public.baseURL + "/storage/" + val.thumbnail_path;
      this.details.teamName = val.team_name;
      this.details.memberCount = val.member;
      this.details.introduction = val.introduction;
      this.details.average = val.average;
      this.details.fromAge = val.from_age;
      this.details.toAge = val.to_age;
      this.details.detailAreas = val.detail_area;
      this.details.detailActivities = val.detail_activity;
      this.details.activeDate = val.active_date;
      this.details.activeDateDetail = val.active_date_detail;
      this.details.teamUrl = val.team_url;
      this.details.schedule = val.schedule;
      this.details.userId = val.user_id;
      val.rides.forEach((ride) => {
        this.details.rides.push(ride.name);
      });
      val.areas.forEach((area) => {
        this.details.areas.push(area.name);
      });
      val.active_date.forEach((date) => {
        this.details.activeDate.push(date.name);
      });
    },
    deleteTeamValue(){
      this.details = new Object({
        pathHeader: "",
        pathThumbnail: "",
        itemId: "",
        userId: "",
        headerImg: "",
        thumbnail: "",
        teamName: "",
        average: "",
        fromAge: "",
        toAge: "",
        rides: [],
        areas: [],
        detailAreas: "",
        introduction: "",
        memberCount: 0,
        detailActivities: "",
        schedule: "",
        activeDate: [],
        activeDateDetail: "",
        teamUrl: "",
        urlHeaderImg: config.public.appURL + "/images/noimage.jpg",
        urlThumbnail: config.public.appURL + "/images/noimage.jpg",
      })
    },
    persist: true,
  },
});
