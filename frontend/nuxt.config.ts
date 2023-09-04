// https://nuxt.com/docs/api/configuration/nuxt-config

import vuetify from "vite-plugin-vuetify";

export default defineNuxtConfig({
  ssr:false,
  devtools: { enabled: true },
  build: {
    transpile: ["vuetify"],
  },
  css: ['@/assets/styles/main.scss'],
  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    },
  },
  modules: [
    '@pinia/nuxt',
    '@pinia-plugin-persistedstate/nuxt',
    '@vee-validate/nuxt',
    '@vueuse/nuxt',
  ],
  hooks: {
    "vite:extendConfig": (config) => {
      config.plugins!.push(vuetify({}));
    },
  },
  runtimeConfig:{
    public:{
      baseURL:process.env.BASE_URL,
      appURL:process.env.APP_URL
    }
  },
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
})
