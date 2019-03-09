export default {
    getOferta(state, payload) {
        state.oferta = payload;
    },
    setGrupos(state, payload){
        let index = state.oferta.findIndex(function (item) {
            return item.id === payload.id
        });
        state.oferta[index].grupos = payload.grupos;
    }
}
