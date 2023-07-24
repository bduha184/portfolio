import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

import "vuetify/styles";
import { aliases, mdi } from 'vuetify/iconsets/mdi-svg'


export default defineNuxtPlugin(nuxtApp => {
  const vuetify = createVuetify({
    ssr: true,
    components,
    directives,
    theme: {
      themes: {
        light: {
          colors: {
            primary: '#fff',
            background: '#fff',
            error: '#d63031',
            info: '#0984e3',
            secondary: '#EDF2F7',
            success: '#00cec9',
            surface: '#fff',
            warning: '#2d3436',
          },
          dark: false,
          variables: {},
        },
      },
    },
    icons: {
      defaultSet: 'mdi',
      aliases,
      sets: {
        mdi,
      },
    },
  })

  nuxtApp.vueApp.use(vuetify)
})
