require('../bootstrap');
window.Vue = require('vue');

import App from './components/App'
import * as VueGoogleMaps from "vue2-google-maps";

Vue.use(VueGoogleMaps, {
    load: {
        key: "AIzaSyDBalo_Mz03Pk3OvjRfT-16RPhTabln68w",
        libraries: "places"
    }
});

import {gmapApi} from 'vue2-google-maps'

let app = new Vue({
    el: '#app',
    components: {
        App,
    },

    computed: {
        google: gmapApi,
    },
});
