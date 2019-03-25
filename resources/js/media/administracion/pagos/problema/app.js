window.swal = require('sweetalert2');
window.axios = require('axios');
window.Vue = require('vue');

import VModal from 'vue-js-modal'
import store from '../store/store';
import BuscarAspiranteForm from '@/media/administracion/pagos/problema/components/BuscarAspiranteFormComponent'
import AspirantesTable from '@/media/administracion/pagos/problema/components/AspirantesTableComponent'

Vue.use(VModal);

let app = new Vue({
    el: '#app',
    components: {
        AspirantesTable,
        BuscarAspiranteForm
    },
    store,
    data: {
        form: {
            referencia: ''
        },
        searching: false,
        ready: false
    },
    computed: {
        billy() {
            return store.state.billy
        },
        hasAProblem() {
            return this.billy.resumen.cant_depositos !== this.billy.resumen.cant_solicitudes;
        },
        billyURL() {
            return store.state.billyURL;
        }
    },
    mounted() {
        store.dispatch('setBillyURL');
        //this.$modal.show('hello-world');
    },
    methods: {
        submit() {
            this.searching = true;
            this.ready = false;
            let referencia = this.form.referencia;
            let url = this.billyURL;

            store.dispatch('buscarReferencia', {referencia, url})
                .then(res => {
                    this.searching = false;
                    this.ready = true;
                })
                .catch(err => {
                    this.searching = false;
                })
        },
        asignar(payload) {
            store.dispatch('setDeposito', store.getters.getDepositoById(payload));
            this.$modal.show('hello-world');
        },
        hide() {
            this.$modal.hide('hello-world');
        },
    }
});

