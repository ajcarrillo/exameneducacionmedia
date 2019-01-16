export default {
    fetch(state, payload){
        state.aforo = payload.data.aulas;
    }
}
