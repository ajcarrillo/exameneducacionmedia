export default {
    planteles(state, payload) {
        state.planteles.items = payload.items;
        state.planteles.pagination = payload.pagination;
    },
    controles(state, payload) {
        state.controles = payload;
    },
    nivelesEducativos(state, payload) {
        state.nivelesEducativos = payload;
    },
    tiposEducativos(state, payload) {
        state.tiposEducativos = payload;
    },
    subNiveles(state, payload) {
        state.subNiveles = payload;
    },
    seleccionarPlantel(state, payload) {
        state.plantelesSelecionados.push(payload);
    },
    seleccionarTodos(state, payload) {
        state.selectAll = payload;
    },
    desSelecionarPlantel(state, payload) {
        let index = state.plantelesSelecionados.findIndex(function (p) {
            return p.id == payload
        });
        if (index > -1) {
            state.plantelesSelecionados.splice(index, 1);
        }
    }
}
