require('../bootstrap');
window.Vue = require('vue');

import VueRouter from 'vue-router'
import VeeValidate from 'vee-validate'

import App from './views/App';
import Subsistemas from './views/Home';
import CreatePlantel from './views/CreatePlantel';

import store from './store/store';

import { library } from '@fortawesome/fontawesome-svg-core'
import { faCoffee } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faCoffee);
Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.config.productionTip = false;

Vue.use(VueRouter);
Vue.use(VeeValidate);

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: "active",
    routes: [
        {
            path: '/subsistemas',
            component: Subsistemas,
            name: 'subsistemas.home',
        },
        {
            path: '/subsistemas/plantel',
            component: CreatePlantel,
            name: 'subsistemas.plantel',
            props: true
        },
    ]
});

const app = new Vue({
    el: '#app',
    components: {App},
    store,
    router
});
