import { defineStore } from "pinia";
import { useRuntimeConfig } from "#imports";

const config = useRuntimeConfig();
export const useTeamStore = defineStore({
  id: "team",

  state: () => ({
    teams: [],
    tab: "latest",
    page: 0,
    loading: false,
    details: {
      profiles:[],
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
      memberCount: 1,
      detailActivities: "",
      schedule: "",
      days: [],
      detailDays: "",
      teamUrl: "",
      urlHeaderImg: config.public.appURL + "/images/noimage.jpg",
      urlThumbnail: config.public.appURL + "/images/noimage.jpg",
    },
  }),

  getters: {
    getPage: (state) => state.page,
    getLoading: (state) => state.loading,
    getTeams: (state) => state.teams,
    getTeamCount: (state) => state.teams.length,
    getTeamDetail: (state) => state.details,
  },
  actions: {
    async fetchMyTeams() {
      const { data } = await useApiFetch("/api/team/myteam");
      console.log('myteamdata',data);
      if (data.value.team_info != null) {
        this.setTeamValue(data.value.team_info);
      }
    },
    async fetchTeams(keywords?: Array<string | number>) {
      this.loading = true;
      const { data, error } = await useApiFetch("/api/team", {
        method: "POST",
        body: {
          keywords: keywords,
          tab: this.tab,
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
    async fetchAffiliationTeams() {
      const res = await useApiFetch("/api/team/auth");
      console.log('affiliations',res);
      const teams = res.data.value.affiliations;
      if (res.error.value == null && teams) {
        teams.forEach((team) => {
          this.teams.push(team);
        });
      }
    },
    async setTab(tab: string) {
      this.tab = tab;
    },
    async setPageInitialize() {
      this.page = 0;
      this.teams.length = 0;
    },
   async setTeamValue(val) {

      this.details.itemId = val.id;
      this.details.urlHeaderImg =
        config.public.baseURL + "/storage/" + val.header_img_path;
      this.details.urlThumbnail =
        config.public.baseURL + "/storage/" + val.thumbnail_path;
      this.details.teamName = val.team_name;
      this.details.memberCount = val.profiles_count;
      this.details.introduction = val.introduction;
      this.details.average = val.average;
      this.details.fromAge = val.from_age;
      this.details.toAge = val.to_age;
      this.details.detailAreas = val.detail_area;
      this.details.detailActivities = val.detail_activity;
      this.details.detailDays = val.detail_day;
      this.details.teamUrl = val.team_url;
      this.details.schedule = val.schedule;
      this.details.userId = val.user_id;
      val.rides.forEach((ride) => {
        this.details.rides.push(ride.name);
      });
      val.areas.forEach((area) => {
        this.details.areas.push(area.name);
      });
      val.days.forEach((day) => {
        this.details.days.push(day.name);
      });
      val.profiles.forEach((profile) => {
        this.details.profiles.push(profile);
      });
    },
    async deleteTeamValue() {
      this.teams = [];
      this.details = new Object({
        profiles:[],
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
        days: [],
        detailDays: "",
        teamUrl: "",
        urlHeaderImg: config.public.appURL + "/images/noimage.jpg",
        urlThumbnail: config.public.appURL + "/images/noimage.jpg",
      });
    },
    // persist: true,
  },
});
