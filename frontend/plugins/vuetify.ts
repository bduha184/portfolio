import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

import "vuetify/styles";
import { aliases, mdi } from 'vuetify/iconsets/mdi-svg'


export default defineNuxtPlugin(nuxtApp => {
  const vuetify = createVuetify({
    ssr: false,
    components,
    directives,
    theme: {
      themes: {
        light: {
          colors:{
            background: '#f8f8f8',
            surface: '#FFFFFF',
            primary: '#fff',
            secondary: '#ff9800',
            error: '#ef4444',
            info: '#2196F3',
            success: '#22c55e',
            warning: '#f59e0b',
          }
        }
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
