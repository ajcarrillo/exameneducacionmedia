<template>
    <modal
        :name="'grupos-'+ofertaid"
        :pivotY="1"
        classes="v--modal rounded-0"
        height="auto"
        width="100%"
        transition="overlay-fade"
    >
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 py-5">
                    <form @submit.prevent="save">
                        <div class="form-row">
                            <div class="col">
                                <label for="">Grupos</label>
                                <input type="number"
                                       class="form-control text-right"
                                       :min="0"
                                       v-model="grupo.grupos"
                                >
                            </div>
                            <div class="col">
                                <label for="">Alumnos por grupo</label>
                                <input type="number"
                                       class="form-control text-right"
                                       :min="0"
                                       v-model="grupo.alumnos"
                                >
                            </div>
                            <div class="col">
                                <label for="">Total</label>
                                <input type="number"
                                       class="form-control text-right"
                                       :value="grupo.grupos*grupo.alumnos"
                                >
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col">
                                <button class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </modal>

</template>

<script>
    import store from '../../store/store';

    export default {
        name: "GrupoComponent",
        props: ['ofertaid', 'uuid'],
        data() {
            return {
                grupo: {
                    grupos: 0,
                    alumnos: 0,
                    oferta_educativa_id: this.ofertaid
                }
            }
        },
        methods: {
            save() {
                let uuid = this.uuid;
                let ofertaId = this.ofertaid;
                let grupo = this.grupo;

                store.dispatch('oferta/storeGrupo', {uuid, ofertaId, grupo})
                    .then(res => {
                        this.$notify({
                            group: 'notify',
                            title: 'Notificaciones',
                            text: 'La oferta se guardó correctamente',
                            type: 'success'
                        });
                    })
                    .catch(err => {
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
    .overlay-fade-enter-active,
    .overlay-fade-leave-active {
        transition: all 0.2s;
    }

    .overlay-fade-enter,
    .overlay-fade-leave-active {
        opacity: 0;
    }

    .nice-modal-fade-enter-active,
    .nice-modal-fade-leave-active {
        transition: all 0.4s;
    }

    .nice-modal-fade-enter,
    .nice-modal-fade-leave-active {
        opacity: 0;
        transform: translateY(-20px);
    }
</style>
