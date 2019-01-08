import Vue from 'vue'
import App from './App'
import router from './router'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import axios from 'axios'
import VeeValidate from 'vee-validate'

window.axios=axios
Vue.use(VeeValidate);

Vue.use(Vuetify, { theme: {
  primary: '#82B1FF',
  secondary: '#424242',
  accent: '#ee44aa',
  error: '#FF5252',
  info: '#2196F3',
  success: '#4CAF50',
  warning: '#FFC107'
}})

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  render: h => h(App)
})
