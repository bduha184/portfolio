// https://nuxt.com/docs/api/configuration/nuxt-config

import vuetify from "vite-plugin-vuetify";

export default defineNuxtConfig({
  extends: ["./api"],
  runtimeConfig: {
    public: {
      baseUrl:process.env.BASE_URL,
      homeUrl: "/",
      loginUrl: "/login",
      verificationUrl: "/verify-email",
    },
  },
  devtools: { enabled: true },
  build: {
    transpile: ["vuetify"],
  },
  css: ["@/assets/styles/main.scss"],
  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    },
  },
  hooks: {
    "vite:extendConfig": (config) => {
      config.plugins!.push(vuetify({}));
    },
  },
  modules: ["@pinia/nuxt"],
  vite: {
    server: {
      watch: {
        usePolling: true,
      },
    },
    define: {
      "process.env.DEBUG": false,
    },
    css: {
      preprocessorOptions: {
        scss: {
          additionalData: '@import "@/assets/styles/_variables.scss";',
        },
      },
    },
  },
});
