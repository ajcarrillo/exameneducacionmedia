<template>
    <form action="">
        <p class="mb-0 text-center">{{ descuento }}%</p>
        <input @change="changeDescuento"
               class="form-control"
               max="100"
               min="0"
               type="range"
               v-model="descuento">
    </form>
</template>

<script>
    let _ = require('lodash');

    export default {
        props: ['plantel'],
        data() {
            return {
                descuento: 0,
                updating: false,
            }
        },
        mounted() {
            this.descuento = this.plantel.descuento;
        },
        methods: {
            changeDescuento: _.debounce(function () {
                axios.patch(route('media.administracion.planteles.update.descuento', this.plantel.id), {
                    descuento: this.descuento
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
        }
    }
</script>

<style scoped>

</style>
