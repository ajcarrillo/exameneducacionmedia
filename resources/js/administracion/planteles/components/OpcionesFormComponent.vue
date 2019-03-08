<template>
    <form action="">
        <p class="mb-0 text-center">{{ opciones }}</p>
        <input @change="changeOpciones"
               class="form-control"
               max="10"
               min="1"
               type="range"
               v-model="opciones">
    </form>
</template>

<script>
    let _ = require('lodash');

    export default {
        props: ['plantel'],
        data() {
            return {
                opciones: 1,
            }
        },
        mounted() {
            this.opciones = this.plantel.opciones;
        },
        methods: {
            changeOpciones: _.debounce(function () {
                axios.patch(route('media.administracion.planteles.update.opciones', this.plantel.id), {
                    opciones: this.opciones
                }).then(res => {
                    this.$notify({
                        group: 'foo',
                        title: 'Notificación',
                        text: 'El descuento se actualizó correctamente',
                        type: 'success'
                    });
                }).catch(err => {
                    console.log(err.response);
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Lo sentimos, algo ha salido mal intenta de nuevo',
                    })
                })
            }, 600)
        },
    }
</script>

<style scoped>

</style>
