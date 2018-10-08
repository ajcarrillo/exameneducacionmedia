export default {
    getPlantelById: (state) => (id) => {
        return state.planteles.find(plantel => plantel.id === id);
    }
}
