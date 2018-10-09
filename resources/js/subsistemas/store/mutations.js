export default {
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
    },
    updateStatusPlantel(state, payload) {
        state.planteles[payload.index].active = payload.active;
    },
    asignarResponsable(state, payload) {
        state.planteles[payload.index].responsable = payload.responsable;
    }
}
