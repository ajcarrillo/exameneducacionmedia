import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        subsistema: null,
        planteles: [],
        especialidades: []
    },
    actions: {
        getData(context, payload) {
            return new Promise(function (resolve, reject) {
                axios.get(route('api.subsistemas.show', payload))
                    .then(res => {
                        context.commit('subsistema', res.data.subsistema);
                        context.commit('planteles', res.data.subsistema.planteles);
                        context.commit('especialidades', res.data.subsistema.especialidades);
                        resolve(res);
                    })
                    .catch(err => {
                        console.log(err.response);
                        reject(err)
                    })
            })
        }
    },
    mutations: {
        subsistema(state, subsistema) {
            state.subsistema = {
                id: subsistema.id,
                referencia: subsistema.referencia,
                descripcion: subsistema.descripcion,
            }
        },
        planteles(state, planteles) {
            state.planteles = planteles;
        },
        especialidades(state, especialidades) {
            state.especialidades = especialidades;
        }
    }
})
