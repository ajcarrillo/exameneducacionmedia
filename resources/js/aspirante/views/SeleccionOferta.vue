<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <label for="">Municipio</label>
                <select v-model="municipioSelected" class="form-control" required>
                    <option value="">Seleccione...</option>
                    <option v-for="municipio in municipios"
                            :value="municipio.CVE_MUN"
                            :key="municipio.CVE_MUN"
                    >{{ municipio.NOM_MUN }}
                    </option>
                </select>
            </div>
            <div class="col">
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
            <div class="col">
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
            <div class="col"></div>
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
                municipioSelected: '',
                localidadSelected: '',
                plantelSelected: ''
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
                axios.get(route('api.localidad.index'), {
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
            }
        }
    }
</script>

<style scoped>

</style>
