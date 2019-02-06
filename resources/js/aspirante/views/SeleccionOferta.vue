<template>
    <div class="container-fluid">
        <div class="row pt-5">
            <div class="col">
                <p class="text-center"><b>Selecciona un municipio</b></p>
                <div class="d-flex flex-row flex-wrap justify-content-center bd-highlight mb-3">
                    <template v-for="municipio in municipios">
                        <div class="mb-3 pr-1">
                            <button
                                class="btn btn-sm"
                                @click="selectMunicipio(municipio.CVE_MUN)"
                                :class="{'btn-primary': municipioSelected == municipio.CVE_MUN, 'btn-default': municipioSelected != municipio.CVE_MUN}"
                            >{{ municipio.NOM_MUN }}
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <label for="">Localidad</label>
                <multiselect
                    :close-on-select="true"
                    :multiple="false"
                    :options="localidades"
                    :searchable="true"
                    deselectLabel="Presiona enter para remover"
                    label="label"
                    placeholder="Seleciona"
                    selectLabel="Presiona enter para seleccionar"
                    selectedLabel="Seleccionado"
                    track-by="value"
                    v-model="localidadSelected"
                >
                </multiselect>
            </div>
            <div class="col-12 mb-3">
                <label for="">Plantel</label>
                <multiselect
                    :close-on-select="true"
                    :multiple="false"
                    :options="planteles"
                    :searchable="true"
                    deselectLabel="Presiona enter para remover"
                    label="descripcion"
                    placeholder="Seleciona"
                    selectLabel="Presiona enter para seleccionar"
                    selectedLabel="Seleccionado"
                    track-by="id"
                    v-model="plantelSelected"
                >
                </multiselect>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="">Especialidades</label>
                <select class="form-control" v-model="especialidadSelected">
                    <option value="">Selecciona...</option>
                    <option v-for="especialidad in especialidades"
                            :value="especialidad"
                    >
                        {{ especialidad.especialidad.referencia }}
                    </option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button :disabled="!hasEspecialidadSelected || existeEspecialidad || hasTresPlanteles || (opcionesPorElegir === 0 && opcionesAElegir !== 0)"
                        @click="agregaOpcion"
                        class="btn btn-success">Agregar
                </button>
                <button :disabled="!hasSeleccion"
                        @click="deshacer"
                        class="btn btn-danger">Deshacer
                </button>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col" v-if="hasSeleccion">
                <h5 class="mb-0">Opciones a elegir: {{ opcionesRestantes }}</h5>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="alert alert-warning" role="alert" v-if="existeEspecialidad">
                    <strong>¡Atención!</strong> La especialidad seleccionada ya se encuentra entre tus preferencias.
                </div>
                <div class="alert alert-warning" role="alert" v-if="hasTresPlanteles">
                    <strong>¡Atención!</strong> Solo puedes elegir hasta tres especialidades en un mismo plantel.
                </div>
            </div>
        </div>
        <div class="row mb-3" v-if="puedeEnviar">
            <div class="col">
                <button class="btn btn-success"
                        :disabled="submited"
                        @click="save">Guardar
                </button>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="1%">Preferencia</th>
                                <th>Plantel</th>
                                <th>Especialidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="opcion in seleccion">
                                <td scope="row">{{ opcion.preferencia }}</td>
                                <td>{{ opcion.plantel.descripcion }}</td>
                                <td>{{ opcion.especialidad.referencia }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';

    export default {
        name: "app",
        components: {
            Multiselect
        },
        props: ['mun', 'opciones', 'escuelas'],
        data() {
            return {
                form: {
                    preferencia: '',
                    oferta_educativa_id: ''
                },
                seleccion: [],
                localidades: [],
                especialidades: [],
                municipioSelected: '',
                localidadSelected: '',
                plantelSelected: '',
                especialidadSelected: '',
                submited: false
            }
        },
        created() {
            axios.get(route('aspirante.opciones.educativas.index'))
                .then(res => {
                    let seleccion = res.data.seleccion;
                    seleccion.length ? this.seleccion = seleccion : [];
                })
                .catch(err => {
                    console.log(err.response);
                })
        },
        watch: {
            municipioSelected() {
                this.localidadSelected = {};
                this.plantelSelected = {};
                this.especialidadSelected = '';
                this.localidades = [];
                this.especialidades = [];
                axios.get(route('api.localidad.plantel.index'), {
                    params: {
                        'cve_mun': this.municipioSelected
                    }
                })
                    .then(res => {
                        this.localidades = res.data.localidades;
                    })
                    .catch(err => {
                        console.log(err);
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Lo sentimos, algo ha salido mal intenta de nuevo',
                        })
                    })
            },
            localidadSelected() {
                this.plantelSelected = {};
                this.especialidades = [];
                this.especialidadSelected = '';
            },
            plantelSelected() {
                axios.get(route('especialidades.index'), {
                    params: {
                        'plantel_id': this.plantelSelected.id
                    }
                })
                    .then(res => {
                        this.especialidades = res.data.especialidades;
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            }
        },
        computed: {
            puedeEnviar() {
                return this.seleccion.length ? this.seleccion.length === this.opcionesAElegir : false;
            },
            opcionesRestantes() {
                return `${this.opcionesPorElegir} de ${this.opcionesAElegir}`
            },
            opcionesAElegir() {
                return this.seleccion.length ? this.seleccion[0].plantel.opciones : 0;
            },
            opcionesPorElegir() {
                return this.opcionesAElegir - this.seleccion.length;
            },
            hasTresPlanteles() {
                let that = this;
                let result = this.seleccion.filter(function (item) {
                    return item.plantel_id === that.especialidadSelected.plantel_id;
                });

                return result.length >= 3;
            },
            existeEspecialidad() {
                let that = this;
                let result = this.seleccion.filter(function (item) {
                    return item.id === that.especialidadSelected.id;
                });

                return result.length > 0;
            },
            hasEspecialidadSelected() {
                return this.especialidadSelected !== "";
            },
            hasSeleccion() {
                return this.seleccion.length;
            },
            municipios() {
                return this.mun;
            },
            opcionesEducativas() {
                return this.opciones;
            },
            planteles() {
                let that = this;
                return this.escuelas.filter(function (el) {
                    return el.cve_mun == that.municipioSelected && el.cve_loc == that.localidadSelected.value;
                })
            }
        },
        methods: {
            selectMunicipio(value) {
                this.municipioSelected = value;
            },
            agregaOpcion() {
                this.especialidadSelected.preferencia = this.seleccion.length + 1;
                this.seleccion.push(this.especialidadSelected);
                this.especialidadSelected = '';
            },
            deshacer() {
                this.seleccion.pop();
            },
            save() {
                swal({
                    title: '¿Estás seguro?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, estoy seguro!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value) {
                        this.submited = true;
                        axios.post(route('aspirante.opciones.educativas.store'), {
                            seleccion: this.seleccion
                        })
                            .then(res => {
                                swal({
                                    type: 'success',
                                    text: 'Tus opciones educativas se guardaron correctamente',
                                });
                                this.submited = false;
                            })
                            .catch(err => {
                                console.log(err.response);
                                swal({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: 'Lo sentimos, algo ha salido mal intenta de nuevo',
                                });
                                this.submited = false;
                            })
                    }
                });
            }

        }
    }
</script>

<style scoped>

</style>
