require('@/bootstrap');
window.Vue = require('vue');

import SubsistemaOfertaDemanda from './components/SubsistemaOfertaDemandaComponent';
import AspiranteSexo from './components/AspirantesSexoComponent';
import Pagos from './components/PagosComponent';

const app = new Vue({
    el: '#app',
    components: {
        Pagos,
        AspiranteSexo,
        SubsistemaOfertaDemanda,
    },
    data: {}
});
