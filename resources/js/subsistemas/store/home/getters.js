export default {
    getPlantelById: (state) => (id) => {
        let plantel = state.planteles.find(plantel => plantel.id == id);
        let index = state.planteles.findIndex(plantel => plantel.id == id);
        return {plantel, index};
    }
}
