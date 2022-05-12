require('./bootstrap');


import Vue from 'vue'
import App from './App.vue'
// import vuetify from './plugins/vuetify'
import router from './router'
import vuetify from './plugins/vuetify' // path to vuetify export
import { createPinia, PiniaVuePlugin } from 'pinia'

Vue.config.productionTip = false

Vue.use(PiniaVuePlugin)
const pinia = createPinia()

new Vue({
  vuetify,
  router,
  pinia,
  render: h => h(App)
}).$mount('#app')


