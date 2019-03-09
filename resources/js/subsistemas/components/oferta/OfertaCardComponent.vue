<template>
    <li class="">
        <div class="row pl-3 pt-3 pr-3">
            <div class="col">
                <div class="d-sm-flex flex-sm-row align-items-center">
                    <div class="pr-3 d-inline-flex">
                        <button @click="desactivar(oferta.id)" class="btn btn-sm btn-info" v-if="oferta.active">{{ oferta.active|tagEstatus }}</button>
                        <button @click="activar(oferta.id)" class="btn btn-sm btn-danger" v-else>{{ oferta.active|tagEstatus }}</button>
                    </div>
                    <div class="pr-3 d-inline-flex">
                        <button @click="eliminarOferta(oferta.id)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </div>
                    <div class="pr-3 pt-3 pt-sm-0">
                        <span style="font-size: 18px; font-weight: bold;">{{ oferta.especialidad.referencia}}</span>
                    </div>
                </div>
                <div class="d-flex flex-row pt-3">
                    <p>{{ oferta.especialidad.descripcion }}</p>
                </div>
                <div class="d-flex flex-row pt-3">
                    <p><strong>Programa de estudios: </strong>{{ oferta.programa_estudio.descripcion}}</p>
                </div>
            </div>
        </div>
        <div class="d-flex flex-row align-items-center bg-light p-3" v-if="!editGroups">
            <div class="pr-3">
                <label for="" class="mb-0">Grupos:</label>
                <span>{{ grupos }}</span></div>
            <div class="pr-3">
                <label for="" class="mb-0">Alumnos por grupo:</label>
                <span>{{ alumnosPorGrupo }}</span></div>
            <div class="pr-3">
                <label for="" class="mb-0">Total:</label>
                <span>{{ total }}</span></div>
            <div class="pr-3">
                <button class="btn btn-primary btn-sm" @click="editGroups = !editGroups">Editar</button>
            </div>
        </div>
        <div class="d-flex flex-row align-items-center bg-light p-3" v-if="editGroups">
            <form @submit.prevent="agregarGrupos" class="form-inline">
                <label for="" class="mr-2">Grupos</label>
                <input type="number" min="1" step="1" class="form-control mr-3 text-right" v-model="formGrupos.grupos">
                <label for="" class="mr-2">Alumnos por grupo</label>
                <input type="number" min="1" step="1" class="form-control mr-3 text-right" v-model="formGrupos.alumnos">
                <label for="" class="mr-2">Total</label>
                <input type="text" class="form-control mr-3 text-right" disabled :value="formGrupos.grupos*formGrupos.alumnos">
                <button class="btn btn-success btn-sm mr-3">Guardar</button>
                <button @click="editGroups = !editGroups" class="btn btn-danger btn-sm" type="button">Cerrar</button>
            </form>
        </div>
    </li>
</template>

<script>
    import store from '../../store/store';

    export default {
        name: "OfertaCardComponent",
        components: {

        },
        props: ['oferta'],
        data() {
            return {
                expanded: false,
                editGroups: false,
                formGrupos: {
                    alumnos: this.oferta.grupos ? this.oferta.grupos.alumnos : 0,
                    grupos: this.oferta.grupos ? this.oferta.grupos.grupos : 0
                }
            }
        },
        filters: {
            tagEstatus(value) {
                return value ? 'Desactivar' : 'Activar';
            }
        },
        computed: {
            hasGrupos() {
                return this.oferta.grupos !== null;
            },
            total() {
                return this.alumnosPorGrupo * this.grupos;
            },
            grupos() {
                return this.hasGrupos ? this.oferta.grupos.grupos : 0
            },
            alumnosPorGrupo() {
                return this.hasGrupos ? this.oferta.grupos.alumnos : 0;
            },
            uuid() {
                return this.$route.params.plantelid;
            }
        },
        methods: {
            agregarGrupos() {
                let ofertaId = this.oferta.id;
                let uuid = this.uuid;
                let grupo = {
                    grupos: this.formGrupos.grupos,
                    alumnos: this.formGrupos.alumnos,
                    oferta_educativa_id: ofertaId
                };
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
            },
            activar(ofertaId) {
                let uuid = this.uuid;

                store.dispatch('oferta/activarOferta', {uuid, ofertaId})
                    .then(res => {
                        store.dispatch('oferta/getOferta', uuid);
                        this.$notify({
                            group: 'notify',
                            title: 'Notificaciones',
                            text: 'La oferta ha sido activada',
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
            },
            desactivar(ofertaId) {
                let uuid = this.uuid;

                store.dispatch('oferta/desactivarOferta', {uuid, ofertaId})
                    .then(res => {
                        store.dispatch('oferta/getOferta', uuid);
                        this.$notify({
                            group: 'notify',
                            title: 'Notificaciones',
                            text: 'La oferta ha sido desactivada',
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
            },
            eliminarOferta(ofertaId) {
                let uuid = this.uuid;

                swal({
                    title: '¿Estás seguro?',
                    text: "¡Esta acción no se pude deshacer!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, estoy seguro!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value) {
                        store.dispatch('oferta/eliminarOferta', {uuid, ofertaId})
                            .then(res => {
                                store.dispatch('oferta/getOferta', uuid);
                                this.$notify({
                                    group: 'notify',
                                    title: 'Notificaciones',
                                    text: 'La oferta ha sido eliminada',
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
                })
            }
        }
    }
</script>

<style scoped>

</style>
