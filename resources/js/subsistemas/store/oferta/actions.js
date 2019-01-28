export default {
    getOferta(context, payload) {
        return new Promise(function (resolve, reject) {
            axios.get(route('api.subsistema.planteles.oferta.index', payload))
                .then(res => {
                    context.commit('getOferta', res.data.plantel.oferta_educativa);
                    resolve(res);
                })
                .catch(err => {
                    reject(err);
                    console.log(err.response)
                })
        })
    },
    storeOferta(context, payload) {
        return new Promise(function (resolve, reject) {
            axios.post(route('api.subsistema.planteles.oferta.store', payload.id), {
                plantel_id: payload.draft.plantel_id,
                especialidad_id: payload.draft.especialidad_id,
                active: payload.draft.active,
                clave: payload.draft.clave,
                programa_estudio_id: payload.draft.programa_estudio_id,
            })
                .then(res => {
                    context.commit('storeOferta', res);
                    resolve(res);
                })
                .catch(err => {
                    console.log(err.response);
                    reject(err);
                })
        });

    },
    activarOferta(context, payload) {
        return new Promise(function (resolve, reject) {
            axios.post(route('api.subsistema.planteles.oferta.activar', payload.uuid), {
                oferta_id: payload.ofertaId
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
    desactivarOferta(context, payload) {
        return new Promise(function (resolve, reject) {
            axios.delete(route('api.subsistema.planteles.oferta.desactivar', {plantel: payload.uuid, ofertaId: payload.ofertaId}))
                .then(res => {
                    resolve(res);
                })
                .catch(err => {
                    console.log(err.response);
                    reject(err);
                })
        })
    },
    eliminarOferta(context, payload) {
        return new Promise(function (resolve, reject) {
            axios.delete(route('api.subsistema.planteles.oferta.eliminar', {plantel: payload.uuid, ofertaId: payload.ofertaId}))
                .then(res => {
                    resolve(res);
                })
                .catch(err => {
                    console.log(err.response);
                    reject(err);
                })
        })
    },
    storeGrupo(context, payload) {
        return new Promise(function (resolve, reject) {
            axios.post(route('api.subsistema.planteles.oferta.grupos', {plantel: payload.uuid, ofertaId: payload.ofertaId}), {
                grupos: payload.grupo.grupos,
                alumnos: payload.grupo.alumnos
            })
                .then(res => {
                    console.log(res);
                    resolve(res);
                })
                .catch(err => {
                    console.log(err.response);
                    reject(err);
                })
        })
    }
}
