import { defineRule, configure } from 'vee-validate'
import { localize, setLocale } from '@vee-validate/i18n'
import ja from '@vee-validate/i18n/dist/locale/ja.json'
import { required, numeric, email, max, min, alpha_num } from '@vee-validate/rules'

export default defineNuxtPlugin((_nuxtApp) => {
  configure({
    generateMessage: localize({
      ja
    })
  })

  defineRule('required', required)
  defineRule('numeric', numeric)
  defineRule('alpha_num', alpha_num)
  defineRule('max', max)
  defineRule('min', min)
  defineRule('email', email)

  localize('ja');
})
