<template>
    <form @submit.prevent="submit">
        <v-select
            v-model="cve_mun"
            :items="municipios"
            item-text="NOM_MUN"
            item-value="CVE_MUN"
            label="Municipio"
            v-validate="'required'"
            data-vv-name="cve_mun"
            :error-messages="errors.collect('cve_mun')"
        ></v-select>
        <v-autocomplete
            v-model="cve_loc"
            :items="localidades"
            :loading="isLoading"
            item-text="NOM_LOC"
            item-value="CVE_LOC"
            label="Localidad"
            v-validate="'required'"
            data-vv-name="cve_loc"
            :error-messages="errors.collect('cve_loc')">
            <template slot="no-data">
                Selecione un municipio
            </template>
        </v-autocomplete>
        <v-text-field :error-messages="errors.collect('colonia')" data-vv-name="colonia" v-validate="'required'" label="Colonia" v-model="colonia"></v-text-field>
        <v-text-field :error-messages="errors.collect('calle')" data-vv-name="calle" v-validate="'required'" label="Calle" v-model="calle"></v-text-field>
        <v-text-field :error-messages="errors.collect('numero')" data-vv-name="numero" v-validate="'required'" label="Número" v-model="numero"></v-text-field>
        <v-text-field label="Código Postal" v-model="codigo_postal"></v-text-field>

        <v-btn class="success" type="submit">Guardar</v-btn>
        <v-btn @click="back">Regresar</v-btn>
    </form>
</template>

<script>
    export default {
        $_veeValidate: {
            validator: 'new'
        },
        props: ['municipios', 'plantel'],
        components: {},
        data() {
            return {
                cve_ent: '23',
                cve_mun: '',
                cve_loc: '',
                colonia: null,
                calle: null,
                numero: null,
                codigo_postal: null,
                localidades: [],
                isLoading: false,
                dictionary: {
                    custom: {
                        cve_mun: {
                            required: 'Por favor selecciona un municipio'
                        },
                        cve_loc: {
                            required: 'Por favor selecciona una localidad'
                        },
                        calle: {
                            required: 'La calle es requerida'
                        },
                        numero: {
                            required: 'El número es requerido'
                        },
                        colonia: {
                            required: 'La colonia es requerida'
                        }
                    }
                }
            }
        },
        mounted() {
            this.$validator.localize('es', this.dictionary);
        },
        computed: {
            municipio() {
                return this.cve_mun
            },
            hasErrors() {
                return !!this.errors.items.length;
            }
        },
        watch: {
            municipio(val) {
                this.localidades = [];
                this.isLoading = true;
                axios.get(route('api.localidad.index', {municipio_id: val}))
                    .then(res => {
                        this.localidades = res.data.localidades;
                        this.isLoading = false;
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            }
        },
        methods: {
            back() {
                this.$router.push({name: 'subsistemas.home'});
            },
            submit() {
                this.$validator.validateAll()
                    .then(result => {
                        if (result) {
                            console.log('do submit');
                        } else {
                            console.log('obligame perro')
                        }
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        }
    }
</script>

<style scoped>

</style>
