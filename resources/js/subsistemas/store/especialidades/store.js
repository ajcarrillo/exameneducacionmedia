import actions from './actions'
import mutations from './mutations'

export default {
    namespaced: true,
    state: {
        especialidades: [],
    },
    getters: {
        findEspecialidad(state) {
            return function (id) {
                return state.especialidades.find(especialidad => especialidad.id == id);
            }
        }
    },
    actions,
    mutations
}
