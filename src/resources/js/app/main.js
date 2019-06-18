import Vue from 'vue';
import App from './components/App'
import '@assets/scss/app/main.scss'

Vue.config.productionTip = false;

new Vue({
  render: h => h(App)
}).$mount('#np-cookie-solution');
