require('../bootstrap');
window.Vue = require('vue');

import VueRouter from 'vue-router'
import Notifications from 'vue-notification'

import App from './views/App';
import Subsistemas from './views/Home';
import Responsable from './views/Responsable';
import OfertaEducativa from './views/OfertaEducativa';
import Especialidad from './views/Especialidad';

import store from './store/store';

import {library} from '@fortawesome/fontawesome-svg-core'
import {faCoffee} from '@fortawesome/free-solid-svg-icons'
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import MyTooltip from '../directives/TooltipDirective';
import VModal from 'vue-js-modal';

Vue.directive('tooltip', MyTooltip);

library.add(faCoffee);
Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.config.productionTip = false;

Vue.use(VueRouter);
Vue.use(Notifications);
Vue.use(VModal);

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
            path: '/subsistemas/especialidades',
            component: Especialidad,
            name: 'subsistema.especialidades'
        },
        {
            path: '/subsistemas/plantel/:plantelid/oferta',
            component: OfertaEducativa,
            name: 'subsistema.plantel.oferta'
        },
        {
            path: '/subsistemas/plantel/:plantelid/responsable',
            component: Responsable,
            name: 'subsistema.plantel.responsable'
        }
    ]
});

const app = new Vue({
    el: '#app',
    components: {App},
    store,
    router
});
