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
    subNiveles(state, payload){
        state.subNiveles = payload;
    },
    seleccionarPlantel(state, payload) {
        state.plantelesSelecionados.push(payload);
    },
    selecionarTodos(state, payload) {
        
    }
}
