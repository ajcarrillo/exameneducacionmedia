export default {
    getEspecialidades(context, payload) {
        return new Promise(function (resolve, reject) {
            axios.get(route('api.subsistema.especialidades.index'))
                .then(res => {
                    context.commit('getEspecialidades', res);
                    resolve(res);
                })
                .catch(err => {
                    reject(err);
                })
        })
    },
    storeEspecialidad(context, payload) {
        return new Promise(function (resolve, reject) {
            axios.post(route('api.subsistema.especialidades.store'), {
                referencia: payload.referencia,
                descripcion: payload.descripcion
            })
                .then(res => {
                    context.commit('storeEspecialidad', res);
                    resolve(res);
                })
                .catch(err => {
                    reject(err);
                    console.log(err.response);
                })
        })
    },
    updateEspecialidad(context, payload) {
        return new Promise(function (resolve, reject) {
            axios.patch(route('api.subsistema.especialidades.update', payload.id), {
                referencia: payload.draft.referencia,
                descripcion: payload.draft.descripcion,
            })
                .then(res=>{
                    context.commit('updateEspecialidad', res);
                    resolve(res);
                })
                .catch(err=>{
                    reject(err);
                    console.log(err.response);
                })
        })
    }
}
