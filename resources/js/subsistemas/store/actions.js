export default {
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
            axios.post(route('api.plantel.responsable', {plantel: payload.responsable.plantelId}), {
                nombre: payload.responsable.nombre,
                primer_apellido: payload.responsable.primer_apellido,
                segundo_apellido: payload.responsable.segundo_apellido,
                email: payload.responsable.email,
                username: payload.responsable.username,
                password: payload.responsable.password,
            }).then(res => {
                payload = {
                    responsable: res.data.responsable,
                    index: payload.responsable.plantelIndex
                };
                contex.commit('asignarResponsable', payload);
                resolve(res);
            }).catch(err => {
                console.log(err.response);
                reject(err);
            })
        })
    }
}
