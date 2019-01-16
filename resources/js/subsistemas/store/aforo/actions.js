export default {
    fetch(context, payload) {
        return new Promise(function (resolve, reject) {
            axios.get(route('api.subsistema.planteles.aforo.index', {plantel: payload.uuid}))
                .then(res => {
                    context.commit('fetch', res);
                    resolve(res);
                })
                .catch(err => {
                    console.log(err.response);
                    reject(err);
                })
        })
    },
    store(context, payload) {
        return new Promise(function (resolve, reject) {
            axios.post(route('api.subsistema.planteles.aforo.store', {plantel: payload.uuid}), {
                referencia: payload.aula.referencia,
                capacidad: payload.aula.capacidad
            })
                .then(res => {
                    resolve(res);
                })
                .catch(err => {
                    console.log(err.response);
                    reject(err);
                })
        })
    },
    destroy(context, payload) {
        return new Promise(function (resolve, reject) {
            axios.delete(route('api.subsistema.planteles.aforo.destroy', {plantel: payload.uuid, aulaId: payload.aulaId}))
                .then(res => {
                    resolve(res);
                })
                .catch(err => {
                    console.log(err.response);
                    reject(err);
                })
        })
    }
}
