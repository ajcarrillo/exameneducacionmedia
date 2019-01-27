<template>
    <form @submit.prevent="save">
        <div class="form-group">
            <label for="cve_mun">Municipio</label>
            <select class="form-control" name="cve_mun" v-model="draft.cve_mun">
                <option value="">Seleccione...</option>
                <option :key="municipio.CVE_MUN"
                        :value="municipio.CVE_MUN"
                        v-for="municipio in municipios"
                >
                    {{ municipio.NOM_MUN }}
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="cve_loc">Localidad</label>
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
        <div class="form-row pb-3">
            <div class="col">
                <label for="">Calle</label>
                <input class="form-control" name="calle" required type="text" v-model="draft.calle">
            </div>
            <div class="col">
                <label for="numero">Número</label>
                <input class="form-control" name="numero" required type="text" v-model="draft.numero">
            </div>
        </div>
        <div class="form-group">
            <label for="">Colonia</label>
            <input class="form-control" name="colonia" required type="text" v-model="draft.colonia">
        </div>
        <div class="form-group">
            <label for="">Código postal</label>
            <input class="form-control" name="codigo_postal" type="text" v-model="draft.codigo_postal">
        </div>
        <div class="form-group mb-0">
            <button class="btn btn-success">Guardar</button>
        </div>
    </form>
</template>

<script>
    import Multiselect from 'vue-multiselect'

    export default {
        name: "FormComponent",
        components: {
            Multiselect
        },
        props: ['domicilio', 'municipios'],
        data() {
            return {
                draft: clone(this.domicilio),
                localidades: [],
                localidadSelected: ''
            }
        },
        created() {
            if (this.draft.id) {
                axios.get(route('api.localidad.index'), {
                    params: {
                        'cve_mun': this.draft.cve_mun
                    }
                })
                    .then(res => {
                        this.localidades = res.data.localidades;
                        let that = this;
                        this.localidadSelected = _.find(this.localidades, function (el) {
                            return el.CVE_ENT === '23' && el.CVE_MUN === that.draft.cve_mun && el.value === that.draft.cve_loc;
                        })
                    })
                    .catch(err => {
                        console.log(err.response)
                    })
            }
        },
        methods: {
            save() {
                this.draft.cve_loc = this.cveLoc;
                this.$emit('save', this.draft);
            }
        },
        computed: {
            cveMun() {
                return this.draft.cve_mun;
            },
            cveLoc() {
                return this.localidadSelected.value;
            }
        },
        watch: {
            cveMun() {
                this.localidadSelected = '';
                axios.get(route('api.localidad.index'), {
                    params: {
                        'cve_mun': this.draft.cve_mun
                    }
                })
                    .then(res => {
                        this.localidades = res.data.localidades
                    })
                    .catch(err => {
                        console.log(err.response)
                    })
            }
        },
    }
</script>

<style scoped>

</style>
