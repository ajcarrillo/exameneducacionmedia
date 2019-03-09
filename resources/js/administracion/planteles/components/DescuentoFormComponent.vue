<template>
    <form action="">
        <p class="mb-0 text-center" v-if="!updating">{{ descuento }}%</p>
        <p class="mb-0 text-center" v-else>Actualizando...</p>
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
                this.updating = true;
                axios.patch(route('media.administracion.planteles.update.descuento', this.plantel.id), {
                    descuento: this.descuento
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
        }
    }
</script>

<style scoped>

</style>
