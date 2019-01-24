<template>
    <div class="card shadow-none border">
        <div class="card-body">
            <informacion-procedencia-form
                :aspiranteid="aspiranteid"
                :informacion="informacion"
                @save="save"
            ></informacion-procedencia-form>
        </div>
    </div>
</template>

<script>
    import InformacionProcedenciaForm from './FormComponent';

    export default {
        name: "CreateComponent",
        components: {
            InformacionProcedenciaForm
        },
        props: ['aspiranteid'],
        data() {
            return {
                informacion: {
                    clave_centro_trabajo: '',
                    nombre_centro_trabajo: '',
                    turno_id: '',
                    fecha_egreso: '',
                    primera_vez: false,
                }
            }
        },
        methods: {
            save(draft) {
                axios.post(route('aspirante.informacion.store', this.aspiranteid), {
                    clave_centro_trabajo: draft.clave_centro_trabajo,
                    nombre_centro_trabajo: draft.nombre_centro_trabajo,
                    turno_id: draft.turno_id,
                    fecha_egreso: draft.fecha_egreso,
                    primera_vez: draft.primera_vez,
                })
                    .then(res => {
                        swal({
                            type: 'success',
                            text: 'La información ha sido guardada correctamente',
                        })
                    })
                    .catch(err => {
                        console.log(err.response);
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Lo sentimos, algo ha salido mal intenta de nuevo',
                        })
                    })
            }
        }
    }
</script>

<style scoped>

</style>
