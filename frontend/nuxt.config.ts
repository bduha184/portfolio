export default defineNuxtConfig({
  ssr:false,
  spaLoadingTemplate: './app/spa-loading-template.html',
  app:{
    head: {
      htmlAttrs: { lang: 'ja' },
      titleTemplate: '%s | Cycle Community',
      title: 'Cycle Community',
      meta: [
        { charset: 'utf-8' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1' },
        { hid: 'description', name: 'description', content: 'Cycle Community' },
        { name: 'format-detection', content: 'telephone=no' },
        { hid: 'og:site_name', property: 'og:site_name', content: 'Cycle Community' },
        { hid: 'og:type', property: 'og:type', content: 'website' },
        { hid: 'og:url', property: 'og:url', content: 'http://localhost:3000/' },
        { hid: 'og:title', property: 'og:title', content: 'Cycle Community' },
        { hid: 'og:description', property: 'og:description', content: 'Cycle Community' },
        { hid: 'og:image', property: 'og:image', content: 'http://locahost:3000/ogp/ogp-image.png' },
        { name: 'twitter:card', content: 'summary' }
      ],
      link: [
        { rel: 'shortcut icon',type: 'image/x-icon', href: '/favicon.ico' },
        { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap' }
      ]
    },
  },
  devtools: { enabled: true },
  css: [
    '@/assets/styles/main.scss',
  ],
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
