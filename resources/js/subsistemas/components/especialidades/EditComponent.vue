<template>
    <td>
        <span
            v-tooltip:top="'Click para editar'"
            @click="$modal.show('editar-'+especialidad.id)">
            <i class="fa fa-pen"></i>&nbsp;
            {{ especialidad.referencia }}
        </span>
        <modal
            :name="'editar-'+especialidad.id"
            height="auto"
            width="100%"
            :pivotY="1"
        >
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3 pt-5 pb-5">
                        <especialidad-form :especialidad="esp" @save="update"></especialidad-form>
                    </div>
                </div>
            </div>
        </modal>
    </td>
</template>

<script>
    import store from '../../store/store';
    import EspecialidadForm from './EspecialidadForm';

    export default {
        name: "EditComponent",
        components: {
            EspecialidadForm,
        },
        props: ['especialidad'],
        computed: {
            esp() {
                let findEspecialidad = store.getters['especialidad/findEspecialidad'];
                return findEspecialidad(this.especialidad.id);
            }
        },
        methods: {
            update(draft) {
                store.dispatch('especialidad/updateEspecialidad', {id: this.especialidad.id, draft})
            }
        }
    }
</script>

<style scoped>

</style>
