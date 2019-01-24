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
        name: "EditComponent",
        components: {
            InformacionProcedenciaForm
        },
        props: ['aspiranteid', 'informacion'],
        data() {
            return {}
        },
        methods: {
            save(draft) {
                axios.patch(route('aspirante.informacion.update', this.informacion.id), draft)
                    .then(res => {
                        swal({
                            type: 'success',
                            text: 'La informacion de procedencia ha sido actualizada correctamente',
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
