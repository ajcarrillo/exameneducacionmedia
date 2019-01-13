export default {
    getEspecialidades(state, payload) {
        state.especialidades = payload.data.especialidades;
    },
    storeEspecialidad(state, payload) {
        state.especialidades.push(payload.data.especialidad);
    },
    updateEspecialidad(state, payload){
        let index = state.especialidades.findIndex(function (el) {
            return el.id == payload.data.especialidad.id;
        });

        state.especialidades[index].referencia = payload.data.especialidad.referencia;
        state.especialidades[index].descripcion = payload.data.especialidad.descripcion;
    }
}
