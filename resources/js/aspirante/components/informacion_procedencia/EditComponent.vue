<template>
    <div class="card shadow-none border">
        <div class="card-body">
            <informacion-procedencia-form
                :aspiranteid="aspiranteid"
                :informacion="informacion"
                :saving="saving"
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
            return {
                saving: false
            }
        },
        methods: {
            save(draft) {
                this.saving = true;
                axios.patch(route('aspirante.informacion.update', this.informacion.id), draft)
                    .then(res => {
                        this.savingDone();
                        swal({
                            type: 'success',
                            text: 'La informacion de procedencia ha sido actualizada correctamente',
                        })
                    })
                    .catch(err => {
                        this.savingDone();
                        console.log(err.response);
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Lo sentimos, algo ha salido mal intenta de nuevo',
                        })
                    })
            },
            savingDone() {
                this.saving = false
            }
        }
    }
</script>

<style scoped>

</style>
