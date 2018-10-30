require('../../bootstrap');
window.Vue = require('vue');

import VeeValidate from 'vee-validate'

import App from './views/App';
import store from './store/store';
import router from './routes';

Vue.config.productionTip = false;

Vue.use(VeeValidate);

const app = new Vue({
    el: '#app',
    components: {App},
    store,
    router
});
