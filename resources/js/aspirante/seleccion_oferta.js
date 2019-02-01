require('../bootstrap');
window.Vue = require('vue');

import App from './views/SeleccionOferta';

const app = new Vue({
    el: '#app',
    components: {
        App
    }
});
