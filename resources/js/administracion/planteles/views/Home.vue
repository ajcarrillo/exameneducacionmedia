<template>
    <div class="container-fluid">
        <div class="row pb-3">
            <div class="col">
                <form @submit.prevent="submitSearchForm">
                    <div class="form-group mb-0">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" v-model="filters.control" :id="'chbx-publico'" :value="1">
                            <label class="form-check-label" :for="'chbx-publico'">PÚBLICO</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" v-model="filters.control" :id="'chbx-privado'" :value="2">
                            <label class="form-check-label" :for="'chbx-privado'">PRIVADO</label>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label for="" class="align-middle mr-sm-2">Tipo:</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input form-control-sm" type="radio" id="tipoTodos" v-model="filters.tipoEducativo" value="">
                            <label class="form-check-label col-form-label-sm" for="tipoTodos">TODOS</label>
                        </div>
                        <div class="form-check form-check-inline" v-for="tipo in tiposEducativos">
                            <input class="form-check-input form-control-sm" type="radio" :id="'tipo-'+tipo.descripcion" v-model="filters.tipoEducativo" :value="tipo.id">
                            <label class="form-check-label col-form-label-sm" :for="'tipo-'+tipo.descripcion">{{ tipo.descripcion }}</label>
                        </div>
                    </div>
                    <div class="form-group mb-0" v-if="filters.tipoEducativo != ''">
                        <label for="" class="align-middle mr-sm-2">Nivel:</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input form-control-sm" type="radio" id="nivelTodos" v-model="filters.nivelEducativo" value="">
                            <label class="form-check-label col-form-label-sm" for="nivelTodos">TODOS</label>
                        </div>
                        <div class="form-check form-check-inline" v-for="nivel in nivelesEducativos">
                            <input class="form-check-input form-control-sm" type="radio" :id="'nivel-'+nivel.id" v-model="filters.nivelEducativo" :value="nivel.id">
                            <label class="form-check-label col-form-label-sm" :for="'nivel-'+nivel.id">{{ nivel.descripcion }}</label>
                        </div>
                    </div>
                    <div class="form-group" v-if="filters.nivelEducativo != ''">
                        <div class="dropdown open">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                Subniveles
                            </button>
                            <div class="dropdown-menu px-3" aria-labelledby="triggerId">
                                <template v-for="subnivel in subNiveles">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" v-model="filters.subNivel" :value="subnivel.id" :id="'sub-'+subnivel.id">
                                        <label class="form-check-label" :for="'sub-'+subnivel.id">
                                            {{ subnivel.descripcion }}
                                        </label>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" v-model="filters.search" class="form-control form-control-sm mr-sm-2" data-toggle="tooltip" title="Buscar por clave o nombre" placeholder="Introduce nombre o clave de centro de trabajo">
                    </div>
                    <button class="btn btn-primary btn-sm" type="submit">Buscar</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-header">
                        <h1 class="card-title">Centros de Trabajo</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <p><strong>Planteles</strong>: {{planteles.pagination.total }}</p>

                            </div>
                            <div class="col">
                                <div class="btn-group btn-group-sm pull-right" role="group" aria-label="Basic example">
                                    <button :disabled="planteles.pagination.previousPageUrl == null || loading" @click="prev" type="button" class="btn btn-secondary">Anterior
                                    </button>
                                    <button :disabled="planteles.pagination.nextPageUrl == null || loading" type="button" @click="next" class="btn btn-secondary">Siguiente
                                    </button>
                                </div>
                                <p><strong>Página</strong>: {{planteles.pagination.currentPage }} <strong>de</strong>: {{planteles.pagination.lastPage}}</p>
                            </div>
                        </div>

                    </div>
                    <div class="card-body p-0 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Clave</th>
                                    <th>Nombre</th>
                                    <th>Municipio</th>
                                    <th>Localidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="loading">
                                    <tr>
                                        <td colspan="2">Cargando datos...</td>
                                    </tr>
                                </template>
                                <template v-else>
                                    <template v-for="plantel in planteles.items">
                                        <tr>
                                            <td>{{ plantel.clave}}</td>
                                            <td>{{ plantel.nombre}}</td>
                                            <td>{{ plantel.inmueble.municipio.NOM_MUN}}</td>
                                            <td>{{ plantel.inmueble.localidad.NOM_LOC}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="border-0 pt-0">
                                                <ul class="list-unstyled" style="font-size: 0.9rem">
                                                    <li class="d-xs-table-row d-lg-table-cell pr-3"><span>{{ plantel.control.descripcion}}</span></li>
                                                    <li class="d-xs-table-row d-lg-table-cell pr-3"><span>{{ plantel.sub_control.descripcion}}</span></li>
                                                    <li class="d-xs-table-row d-lg-table-cell pr-3"><span>{{ plantel.tipo_educativo.descripcion}}</span></li>
                                                    <li class="d-xs-table-row d-lg-table-cell pr-3"><span>{{ plantel.nivel_educativo.descripcion}}</span></li>
                                                    <li class="d-xs-table-row d-lg-table-cell pr-3"><span>{{ plantel.sub_nivel.descripcion}}</span></li>
                                                    <li class="d-xs-table-row d-lg-table-cell pr-3"><span>{{ plantel.tipo_centro_trabajo.descripcion}}</span></li>
                                                    <li class="d-xs-table-row d-lg-table-cell pr-3"><span>{{ plantel.clasificador.descripcion}}</span></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </template>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import store from '../store/store';

    export default {
        name: "Home",
        data() {
            return {
                filters: {
                    control: [],
                    tipoEducativo: '',
                    nivelEducativo: '',
                    estatus: 'activo',
                    search: '',
                    subControl: '',
                    subNivel: [],
                    tipoCentroTrabajo: 9,
                    page: 1,
                },
                loading: false
            }
        },
        created() {
            this.getCentros();
            store.dispatch('getControles');
            store.dispatch('getNivelesEducativos');
            store.dispatch('getTiposEducativos');
            store.dispatch('getSubniveles');
        },
        computed: {
            planteles() {
                return store.state.planteles;
            },
            tiposEducativos() {
                return store.state.tiposEducativos;
            },
            nivelesEducativos() {
                let that = this;
                return store.state.nivelesEducativos.filter(function (item) {
                    return item.tipo_educativo_id == that.filters.tipoEducativo
                });
            },
            subNiveles() {
                let that = this;
                return store.state.subNiveles.filter(function (item) {
                    return item.nivel_educativo_id == that.filters.nivelEducativo;
                })
            },
            tipoEducativoSelected() {
                return this.filters.tipoEducativo
            },
            nivelEducativoSelected() {
                return this.filters.nivelEducativo;
            }
        },
        watch: {
            tipoEducativoSelected(val) {
                this.filters.nivelEducativo = '';
            },
            nivelEducativoSelected(val) {
                this.filters.subNivel = [];
            }
        },
        methods: {
            submitSearchForm() {
                this.filters.page = 1;
                this.getCentros();
            },
            getCentros() {
                this.loading = true;
                store.dispatch('getCentros', this.filters)
                    .then(res => {
                        this.loading = false;
                    });
            },
            next() {
                this.filters.page += 1;
                this.getCentros();
            },
            prev(page) {
                this.filters.page -= 1;
                this.getCentros();
            }
        }
    }
</script>

<style scoped>

</style>
