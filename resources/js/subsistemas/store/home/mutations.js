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
    revision_aforos(state, revision_aforos) {
        state.revision_aforos = revision_aforos;
    },
    isAforo(state, isAforo) {
        state.isAforo = isAforo;
    },
    estado(state, estado) {
        state.estado = estado;
    },
    revision_oferta(state, revision_oferta) {
        state.revision_oferta = revision_oferta;
    },
    isOferta(state, isOferta) {
        state.isOferta = isOferta;
    },
    estadoOferta(state, estadoOferta) {
        state.estadoOferta = estadoOferta;
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
    },
    reloadData: function (state, res) {
        let subsistema = res.data.subsistema,
            planteles = res.data.subsistema.planteles,
            especialidades = res.data.subsistema.especialidades,
            revision_aforos = res.data.subsistema.revision_aforos,
            isAforo = res.data.isAforo,
            estado = res.data.estado,
            revision_oferta = res.data.subsistema.revisiones,
            isOferta = res.data.isOferta,
            estadoOferta = res.data.ofertaEstado;

        state.subsistema = {
            id: subsistema.id,
            referencia: subsistema.referencia,
            descripcion: subsistema.descripcion
        };
        state.planteles = planteles;
        state.especialidades = especialidades;
        state.revision_aforos = revision_aforos;
        state.isAforo = isAforo;
        state.estado = estado;
        state.revision_oferta = revision_oferta;
        state.isOferta = isOferta;
        state.estadoOferta = estadoOferta;
    }
};
