/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Vuetify from 'vuetify'
import VueRouter from 'vue-router'

import Subsistemas from './subsistemas/views/Home';
import Planteles from './planteles/views/Home';

Vue.use(Vuetify);
Vue.use(VueRouter);

Vue.component('app', require('./components/AppComponent'));

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
            path: '/planteles',
            component: Planteles,
            name: 'planteles.home',
        },
    ]
});

const app = new Vue({
    el: '#app',
    data: {
        items: [
            {title: 'Home', icon: 'dashboard'},
            {title: 'About', icon: 'question_answer'}
        ],
    },
    router
});
