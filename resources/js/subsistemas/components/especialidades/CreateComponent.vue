<template>
    <div>
        <button class="btn btn-link btn-sm"
                @click="$modal.show('create-especialidad')">
            <i class="fa fa-plus"></i>&nbsp;
            Agregar
        </button>
        <modal :name="'create-especialidad'"
               height="auto"
               width="100%"
               :pivotY="1"
        >
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3 pt-5 pb-5">
                        <especialidad-form :especialidad="especialidad" @save="save"></especialidad-form>
                    </div>
                </div>
            </div>
        </modal>
    </div>
</template>

<script>
    import store from '../../store/store';
    import EspecialidadForm from './EspecialidadForm';

    export default {
        name: "CreateComponent",
        components: {
            EspecialidadForm,
        },
        data() {
            return {
                especialidad: {
                    referencia: '',
                    descripcion: ''
                }
            }
        },
        methods: {
            save(draft) {
                store.dispatch('especialidad/storeEspecialidad', draft)
                    .then(res=>{
                        this.$modal.hide('create-especialidad');
                    })
                    .catch(err => {
                        swal({
                            type: 'warning',
                            title: 'Oops...',
                            text: err.response.data.meta.message[0],
                        })
                        console.log(err.response);
                    })
            }
        }
    }
</script>

<style scoped>

</style>
