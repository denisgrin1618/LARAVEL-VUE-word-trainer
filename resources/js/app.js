require('./bootstrap');

import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify' 
import pinia from './plugins/pinia'
import VueCookies from 'vue-cookies'
import router from './router'

Vue.config.productionTip = false
Vue.use(VueCookies, { expire: '7d'})

new Vue({
  vuetify,
  pinia,
  router,
  render: h => h(App)
}).$mount('#app')


