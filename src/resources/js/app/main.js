import Vue from 'vue';
import './assets/scss/main.scss'

Vue.config.productionTip = false;

new Vue({
  render: h => h(CookieBanner)
}).$mount('#np-cookie-solution');
