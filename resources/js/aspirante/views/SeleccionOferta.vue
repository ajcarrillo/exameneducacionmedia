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
        <div class="row">
            <div class="col">
                <label for="">Especialidades</label>
                <select class="form-control" v-model="especialidadSelected">
                    <option value="">Selecciona...</option>
                    <option v-for="especialidad in especialidades"
                            :value="especialidad.id"
                    >
                        {{ especialidad.especialidad.referencia }}
                    </option>
                </select>
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
                especialidadSelected: ''
            }
        },
        computed: {
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
        watch: {
            municipioSelected() {
                this.localidadSelected = {};
                this.plantelSelected = {};
                this.especialidadSelected = '';
                this.localidades = [];
                this.especialidades=[];
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
            localidadSelected(){
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
        methods: {
            selectMunicipio(value) {
                this.municipioSelected = value;
            }
        }
    }
</script>

<style scoped>

</style>
