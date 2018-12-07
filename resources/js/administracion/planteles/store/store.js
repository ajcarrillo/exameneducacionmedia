import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate'
import actions from './actions';
import mutations from './mutations';
import getters from './getters';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        subsistemas: [],
        planteles: {
            items: [],
            pagination: {}
        },
        controles: [],
        tiposEducativos: [],
        nivelesEducativos: [],
        subNiveles: [],
        estatus: ['activo', 'inactivo'],
        plantelesSelecionados: []
    },
    getters,
    actions,
    mutations
})
