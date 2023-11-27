// https://nuxt.com/docs/api/configuration/nuxt-config

export default defineNuxtConfig({
  ssr:false,
  app:{
    head: {
      htmlAttrs: { lang: 'ja' },
      titleTemplate: '%s | Cycle Community',
      title: 'Cycle Community',
      meta: [
        { charset: 'utf-8' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1' },
        { hid: 'description', name: 'description', content: 'あなたの防災レベルはいくつ？' }
      ],
      link: [
        { rel: 'icon', href: '/favicon.ico' },
        { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap' }
      ]
    },
  },
  devtools: { enabled: true },
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
    "@invictus.codes/nuxt-vuetify",
  ],
  runtimeConfig:{
    public:{
      baseURL:process.env.BASE_URL,
      appURL:process.env.APP_URL,

    }
  },
  // components: [
  //   {
  //     path: "@/components",
  //     pathPrefix: false,
  //   },
  // ],
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
