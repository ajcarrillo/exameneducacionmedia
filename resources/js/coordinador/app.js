require('@/bootstrap');
window.Vue = require('vue');

import SubsistemaOfertaDemanda from './components/SubsistemaOfertaDemandaComponent';
import AspiranteSexo from './components/AspirantesSexoComponent';

const app = new Vue({
    el: '#app',
    components: {
        AspiranteSexo,
        SubsistemaOfertaDemanda
    },
    data: {}
});
