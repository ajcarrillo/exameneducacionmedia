require('@/bootstrap');
window.Vue = require('vue');

import SubsistemaOfertaDemanda from './components/SubsistemaOfertaDemandaComponent';

const app = new Vue({
    el: '#app',
    components: {
        SubsistemaOfertaDemanda
    },
    data: {}
});
