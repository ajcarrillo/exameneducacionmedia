import Vue from 'vue';
import Vuex from 'vuex';
import home from './home/store';
import aforo from './aforo/store';
import oferta from './oferta/store';
import especialidad from './especialidades/store';

Vue.use(Vuex);

export default new Vuex.Store({
    /*plugins: [createPersistedState()],*/
    modules: {
        home: home,
        aforo: aforo,
        oferta: oferta,
        especialidad: especialidad
    }
})
