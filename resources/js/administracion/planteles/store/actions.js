import axios from 'axios';

let jarvisToken = document.head.querySelector('meta[name="token"]');

const ax = axios.create({
    baseURL: 'http://jarvis.test/api',
    headers: {
        'Authorization': 'Bearer ' + jarvisToken.content,
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    }
});

export default {
    getCentros(context, payload) {
        return new Promise(function (resolve, reject) {
            ax.get('/v1/centros-trabajo', {
                params: payload
            })
                .then(res => {
                    context.commit('planteles', {items: res.data.items, pagination: res.data.pagination});
                    resolve();
                })
                .catch(err => {
                    console.log(err.response);
                    reject();
                })
        })
    },
    getControles(context, payload) {
        return new Promise(function (resolve, reject) {
            ax.get('/v1/centros-trabajo/catalogos?get=controles')
                .then(res => {
                    context.commit('controles', res.data.data)
                    resolve()
                })
                .catch(err => {
                    console.log(reject);
                })
        })
    },
    getNivelesEducativos(context, payload) {
        return new Promise(function (resolve, reject) {
            ax.get('/v1/centros-trabajo/catalogos?get=nivelesEducativos')
                .then(res => {
                    context.commit('nivelesEducativos', res.data.data)
                    resolve()
                })
                .catch(err => {
                    console.log(reject);
                })
        })
    },
    getTiposEducativos(context, payload) {
        return new Promise(function (resolve, reject) {
            ax.get('/v1/centros-trabajo/catalogos?get=tiposEducativos')
                .then(res => {
                    context.commit('tiposEducativos', res.data.data)
                    resolve()
                })
                .catch(err => {
                    console.log(reject);
                })
        })
    },
    getSubniveles(context, payload) {
        return new Promise(function (resolve, reject) {
            ax.get('/v1/centros-trabajo/catalogos?get=subniveles')
                .then(res => {
                    context.commit('subNiveles', res.data.data)
                    resolve()
                })
                .catch(err => {
                    console.log(reject);
                })
        })
    },
    seleccionarPlantel(context, payload) {
        context.commit('seleccionarPlantel', payload);
    },
    selecionarTodos(context, payload) {
        context.commit('selecionarTodos', payload);
    }
}
