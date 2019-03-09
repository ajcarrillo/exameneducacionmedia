<template>
    <form action="">
        <p class="mb-0 text-center" v-if="!updating">{{ opciones }}</p>
        <p class="mb-0 text-center" v-else>Actualizando...</p>
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
                updating: false,
            }
        },
        mounted() {
            this.opciones = this.plantel.opciones;
        },
        methods: {
            changeOpciones: _.debounce(function () {
                this.updating = true;
                axios.patch(route('media.administracion.planteles.update.opciones', this.plantel.id), {
                    opciones: this.opciones
                }).then(res => {
                    this.updating = false;
                    this.$notify({
                        group: 'foo',
                        title: 'Notificación',
                        text: 'El descuento se actualizó correctamente',
                        type: 'success'
                    });
                }).catch(err => {
                    this.updating = false;
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
