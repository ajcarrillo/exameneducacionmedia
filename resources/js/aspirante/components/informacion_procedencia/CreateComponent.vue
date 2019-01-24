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
                console.log(draft);
            }
        }
    }
</script>

<style scoped>

</style>
