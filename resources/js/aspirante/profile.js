require('../bootstrap');
window.Vue = require('vue');

import App from './components/App'

let app = new Vue({
    el: '#app',
    components: {
        App,
    },
});
