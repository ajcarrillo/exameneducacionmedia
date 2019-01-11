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
        let index = state.planteles.findIndex(function (el) {
            return el.uuid == payload.uuid
        });
        state.planteles[index].responsable = payload.responsable;
        state.planteles[index].responsable_id = payload.responsable.id;
    },
    actualizaNombre(state, payload) {
        state.planteles[payload.index].descripcion = payload.draft;
    }
}
