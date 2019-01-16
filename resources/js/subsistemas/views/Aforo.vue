<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Agrega aula</h1>
                        <div class="card-tools">
                            <span class="badge badge-info">{{ `Total aulas: ${totalAulas}` }}</span>
                            <span class="badge badge-info">{{ `Total aspirantes: ${totalAspirantes}` }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="save">
                            <div class="form-row">
                                <div class="col-12 col-sm-6">
                                    <label for="">Aula</label>
                                    <input class="form-control"
                                           required
                                           type="text"
                                           v-model="aula.referencia"
                                    >
                                </div>
                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                    <label for="">Capacidad</label>
                                    <input class="form-control text-right" min="0"
                                           required
                                           type="number"
                                           v-model="aula.capacidad"
                                    >
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-12">
                                    <button class="btn btn-success btn-block">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <section>
                    <div class="info-box" v-for="a in aforo">
                        <span class="info-box-icon bg-info"><i class="fas fa-user-graduate"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">
                                <span class="d-flex flex-row">
                                    <span @click="destroy(a.id)" class="text-danger pr-2" style="cursor: pointer"><i class="fa fa-trash"></i></span>
                                    <span>{{ a.referencia }}</span>
                                </span>
                            </span>
                            <span class="info-box-number">{{ a.capacidad }} aspirantes</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>

<script>
    import store from '../store/store';

    export default {
        name: "Aforo",
        components: {},
        props: [],
        data() {
            return {
                aula: {
                    referencia: '',
                    capacidad: 0
                }
            }
        },
        computed: {
            aforo() {
                return store.state.aforo.aforo;
            },
            uuid() {
                return this.$route.params.plantelid;
            },
            totalAulas() {
                return this.aforo.length;
            },
            totalAspirantes() {
                return _.sumBy(this.aforo, function (el) {
                    return el.capacidad
                })
            }
        },
        methods: {
            save() {
                let uuid = this.uuid;
                let aula = this.aula;

                store.dispatch('aforo/store', {uuid, aula})
                    .then(res => {

                        store.dispatch('aforo/fetch', {uuid});

                        this.aula.referencia = '';
                        this.aula.capacidad = 0;

                        this.$notify({
                            group: 'notify',
                            title: 'Notificaciones',
                            text: 'El aula ha sido guardada correctamente',
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
            destroy(aulaId) {
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
                        let uuid = this.uuid;

                        store.dispatch('aforo/destroy', {uuid, aulaId})
                            .then(res=>{
                                store.dispatch('aforo/fetch', {uuid});

                                this.$notify({
                                    group: 'notify',
                                    title: 'Notificaciones',
                                    text: 'El aula se ha eliminado correctamente',
                                    type: 'success'
                                });
                            })
                            .catch(err=>{
                                swal({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: 'Lo sentimos, algo ha salido mal intenta de nuevo',
                                })
                            })
                    }
                })
            }
        },
        beforeRouteEnter(to, from, next) {
            let uuid = to.params.plantelid;

            store.dispatch('aforo/fetch', {uuid})
                .then(res => {
                    next();
                })
                .catch(err => {
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Lo sentimos, algo ha salido mal intenta de nuevo',
                    })
                })

        },
        beforeRouteUpdate(to, from, next) {
            let uuid = to.params.uuid;

            store.dispatch('aforo/fetch', {uuid})
                .then(res => {
                    next();
                })
                .catch(err => {
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Lo sentimos, algo ha salido mal intenta de nuevo',
                    })
                })
        },
    }
</script>

<style scoped>

</style>
