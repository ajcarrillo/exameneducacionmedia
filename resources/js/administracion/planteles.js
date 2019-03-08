require('../bootstrap');
window.Vue = require('vue');

import Notifications from 'vue-notification'
import DescuentoForm from './planteles/components/DescuentoFormComponent'
import OpcionesForm from './planteles/components/OpcionesFormComponent'

Vue.use(Notifications);

const app = new Vue({
    el: '#app',
    components: {
        DescuentoForm,
        OpcionesForm
    },
    data: {
        formDescuento: {
            descuento: 0
        },
        formOpciones: {
            opciones: 0
        }
    }
});
