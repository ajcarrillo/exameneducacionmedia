import Vue from 'vue';
import VueRouter from "vue-router";

import Home from './views/Home'

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    linkExactActiveClass: "active",
    routes: [
        {
            path: '/administracion/planteles',
            component: Home,
            name: 'planteles.home',
        },
    ]
});
