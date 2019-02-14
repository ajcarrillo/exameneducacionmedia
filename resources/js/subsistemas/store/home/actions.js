export default {
    getData(context, payload) {
        return new Promise(function (resolve, reject) {
            axios.get(route('api.subsistemas.show', payload))
                .then(res => {
                    context.commit('subsistema', res.data.subsistema);
                    context.commit('planteles', res.data.subsistema.planteles);
                    context.commit('especialidades', res.data.subsistema.especialidades);
                    context.commit('revision_aforos', res.data.subsistema.revision_aforos);
                    context.commit('isAforo', res.data.isAforo);
                    context.commit('estado', res.data.estado);
                    context.commit('revision_oferta', res.data.subsistema.revisiones);
                    context.commit('isOferta', res.data.isOferta);
                    context.commit('estadoOferta', res.data.ofertaEstado);
                    resolve(res);
                })
                .catch(err => {
                    console.log(err.response);
                    reject(err)
                })
        })
    },
    activarPlantel(contex, payload) {
        return new Promise(function (resolve, reject) {
            axios.patch(route('api.plantel.activar', {plantel: payload.plantel}), {active: true})
                .then(res => {
                    payload = {
                        active: true,
                        index: payload.index
                    };
                    contex.commit('updateStatusPlantel', payload);
                    resolve(res);
                })
                .catch(err => {
                    console.log(err.response);
                    reject(err);
                })
        })
    },
    desactivarPlantel(contex, payload) {
        return new Promise(function (resolve, reject) {
            axios.delete(route('api.plantel.desactivar', {plantel: payload.plantel}), {data: {active: false}})
                .then(res => {
                    payload = {
                        active: false,
                        index: payload.index
                    };
                    contex.commit('updateStatusPlantel', payload);
                    resolve(res);
                })
                .catch(err => {
                    console.log(err.response);
                    reject(err);
                })
        })
    },
    asignarResponsable(contex, payload) {
        return new Promise(function (resolve, reject) {
            axios.post(route('api.plantel.responsable', {plantel: payload.uuid}), {
                nombre_completo: `${payload.responsable.nombre} ${payload.responsable.primer_apellido} ${payload.responsable.segundo_apellido}`,
                email: payload.responsable.email,
                username: payload.responsable.username,
                password: payload.responsable.password,
            }).then(res => {
                payload = {
                    responsable: res.data.responsable,
                    uuid: payload.uuid
                };
                contex.commit('asignarResponsable', payload);
                resolve(res);
            }).catch(err => {
                console.log(err.response);
                reject(err);
            })
        })
    },
    actualizaNombre(context, payload) {
        context.commit('actualizaNombre', payload);
    },
    storeAforoRevision: function (context) {
        return new Promise(function (resolve, reject) {
            axios.post(route("api.revision.store"))
                .then(res => {
                    context.commit("reloadData", res);
                    resolve(res);
                })
                .catch(err => {
                    console.log(err.response);
                    reject(err);
                });
        });
    },
    storeOfertaRevision: function (context) {
        return new Promise(function (resolve, reject) {
            axios.post(route("api.revision.oferta.store"))
                .then(res => {
                    context.commit("reloadData", res);
                    resolve(res);
                })
                .catch(err => {
                    console.log(err.response);
                    reject(err);
                });
        });
    }
};
