import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        aspirantes: [],
        deposito: {},
        billy: {
            depositos: [],
            resumen: {
                cant_depositos: 0,
                cant_solicitudes: 0
            }
        },
        billyURL: ''
    },
    getters: {
        getDepositoById: state => id => {
            return state.billy.depositos.find(deposito => deposito.id === id);
        }
    },
    mutations: {
        SEARCH_ASPIRANTES(state, payload) {
            state.aspirantes = payload;
        },
        SET_BILLY_URL(state, payload) {
            state.billyURL = payload;
        },
        SEARCH_REFERENCIA(state, payload) {
            state.billy = payload;
        },
        SET_DEPOSITO(state, payload) {
            state.deposito = payload;
        }
    },
    actions: {
        buscarReferencia(context, payload) {
            return new Promise(function (resolve, reject) {
                axios.get(`${payload.url}/${payload.referencia}`)
                    .then(res => {
                        context.commit('SEARCH_REFERENCIA', res.data);
                        resolve(res);
                    })
                    .catch(err => {
                        console.log(err.response);
                        reject(err);
                    })
            });
        },
        setBillyURL(context) {
            let billyUrl = JSON.parse(window.__INITIAL_STATE__) || {};
            context.commit('SET_BILLY_URL', billyUrl);
        },
        buscarAspirnantes(context) {
            return new Promise(function (resolve, reject) {
                axios.get(route('media.administracion.aspirantes.buscar'))
                    .then(res => {
                        context.commit('SEARCH_ASPIRANTES', res.data);
                        resolve(res);
                    })
                    .catch(err => {
                        console.log(err.response);
                        reject(err.response);
                    })
            })
        },
        setDeposito(context, payload) {
            context.commit('SET_DEPOSITO', payload);
        }
    }
})
