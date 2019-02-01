<template>
    <form @submit.prevent="save">
        <div class="form-group">
            <label for="">Especialidad</label>
            <select class="form-control"
                    name=""
                    required
                    v-model="draft.especialidad_id"
            >
                <option value="">Seleccione...</option>
                <option :value="especialidad.id"
                        v-for="especialidad in especialidades"
                >
                    {{ especialidad.referencia }}
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Programa de estudios</label>
            <select class="form-control"
                    name=""
                    required
                    v-model="draft.programa_estudio_id"
            >
                <option value="">Seleccione...</option>
                <option :value="programa.id"
                        v-for="programa in programas"
                >
                    {{ programa.descripcion }}
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Clave</label>
            <input class="form-control"
                   required
                   type="text"
                   v-model="draft.clave"
            >
        </div>
        <div class="form-group mb-0">
            <button class="btn btn-success">Guardar</button>
        </div>
    </form>
</template>

<script>
    import store from '../../store/store'

    export default {
        name: "OfertaForm",
        props: ['oferta', 'especialidades', 'programas'],
        data() {
            return {
                draft: clone(this.oferta)
            }
        },
        methods: {
            save() {
                store.dispatch('oferta/storeOferta', {id: this.draft.plantel_id, draft: this.draft})
                    .then(res => {
                        store.dispatch('oferta/getOferta', this.draft.plantel_id);

                        this.draft.especialidad_id = '';
                        this.draft.clave = '';
                        this.draft.programa_estudio_id = '';

                        this.$notify({
                            group: 'notify',
                            title: 'Notificaciones',
                            text: 'La oferta ha sido guardado correctamente',
                            type: 'success'
                        });
                    })
                    .catch(err => {
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: err.response.data.meta.message[0],
                        })
                    })
            }
        }
    }
</script>

<style scoped>

</style>
