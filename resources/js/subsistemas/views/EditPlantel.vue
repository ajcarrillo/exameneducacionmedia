<template>
    <form @submit.prevent="submit">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card card-primary">
                    <div class="card-header">
                        <h1 class="card-title">Datos del plantel</h1>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" :class="{'input': true, 'has-error': errors.has('descripcion') }" name="descripcion" v-model="plantel.descripcion" autofocus v-validate="'required'">
                            <div class="input-has-error">{{ errors.first('descripcion') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="">CCT</label>
                            <input type="text" class="form-control" :class="{'input': true, 'has-error': errors.has('cct') }" name="cct" v-model="plantel.cct" v-validate="'required'">
                            <div class="input-has-error">{{ errors.first('cct') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="">Teléfono</label>
                            <input type="text" class="form-control" :class="{'input': true, 'has-error': errors.has('telefono') }" name="telefono" v-model="plantel.telefono" v-validate="'required'">
                            <div class="input-has-error">{{ errors.first('telefono') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="">Página web</label>
                            <input type="text" class="form-control" :class="{'input': true, 'has-error': errors.has('pagina_web') }" name="pagina_web" v-model="plantel.pagina_web" placeholder="http://www.example.com" v-validate="'required|url'">
                            <div class="input-has-error">{{ errors.first('pagina_web') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card card-primary">
                    <div class="card-header">
                        <h1 class="card-title">Domicilio</h1>
                    </div>
                    <div class="card-body">
                        <div class="form-group" v-if="isMunicipiosReady">
                            <label for="">Municipio</label>
                            <select name="cve_mun" class="form-control" v-model="plantel.domicilio.cve_mun" @change="onChangeMunicipio">
                                <option value="">Seleccione</option>
                                <option v-for="municipio in municipios" :value="municipio.value" :key="municipio.value">{{ municipio.label }}</option>
                            </select>
                            <div class="input-has-error">{{ errors.first('cve_mun') }}</div>
                        </div>
                        <div class="form-group" v-if="isLocalidadesReady">
                            <label for="">Localidad</label>
                            <v-select :options="localidades" v-model="cveLocSelect2"></v-select>
                            <div class="input-has-error">{{ errors.first('cve_loc') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="">Calle</label>
                            <input type="text" class="form-control" v-model="plantel.domicilio.calle" name="calle" :class="{input:true, 'has-error':errors.has('calle')}" v-validate="'required'">
                            <div class="input-has-error">{{ errors.first('calle') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="">Número</label>
                            <input type="text" class="form-control" v-model="plantel.domicilio.numero" name="numero" :class="{input:true, 'has-error':errors.has('numero')}" v-validate="'required'">
                            <div class="input-has-error">{{ errors.first('numero') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="">Colonia</label>
                            <input type="text" class="form-control" v-model="plantel.domicilio.colonia" name="colonia" :class="{input:true, 'has-error':errors.has('colonia')}" v-validate="'required'">
                            <div class="input-has-error">{{ errors.first('colonia') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="">Código postal</label>
                            <input type="text" class="form-control" v-model="plantel.domicilio.codigo_postal">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-success" type="submit">Guardar</button>
                        <router-link :to="{name:'subsistemas.home'}">
                            <a class="btn btn-default">Regresar</a>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import vSelect from 'vue-select'
    import store from '../store/store';

    export default {
        components: {vSelect},
        data() {
            return {
                plantel: null,
                plantelIndex: null,
                municipios: [],
                isMunicipiosReady: false,
                localidades: [],
                isLocalidadesReady: false,
                cveLocSelect2: null,
                dictionary: {
                    custom: {
                        descripcion: {required: 'El nombre es requerido'},
                        cct: {required: 'La clave de centro de trabajo es requerida'},
                        telefono: {required: 'El teléfono es requerido'},
                        pagina_web: {required: 'La página web es requerida', url: 'La dirección url no tiene el formato correcto',},
                        cve_mun: {required: 'El municipio es requerido'},
                        cve_loc: {required: 'La localidad es requerida'},
                        colonia: {required: 'La colonia es requerida'},
                        calle: {required: 'La calle es requerida'},
                        numero: {required: 'El número es requerido'},
                        codigo_postal: {required: 'El código postal es requerido'},
                        nombre: {required: 'El nombre es requerido'},
                        primer_apellido: {required: 'El primer apellido es requerido'},
                        email: {required: 'El email es requerido', email: 'El email es inválido'},
                        username: {required: 'El username es requerido'},
                        password: {required: 'El password es requerido'},
                    }
                }
            }
        },
        mounted() {
            this.$validator.localize('es', this.dictionary)
        },
        created() {
            let plantelId = this.$route.params.plantelId;
            let payload = store.getters.getPlantelById(plantelId);
            this.plantel = payload.plantel;
            this.plantelIndex = payload.index;
            if(_.isEmpty(this.plantel.domicilio)){
                this.plantel.domicilio = {};
            }

            this.getMunicipios();

        },
        methods: {
            submit() {
                this.$validator.validate()
                    .then(isValid => {
                        if (isValid) {
                            axios.patch(route('api.subsistema.plantel.update', {plantel: this.plantel.id}), {
                                descripcion: this.descripcion,
                                cct: this.cct,
                                telefono: this.telefono,
                                pagina_web: this.pagina_web,
                                cve_ent: '23',
                                cve_mun: this.cve_mun,
                                cve_loc: this.cveLocSelect2.value,
                                colonia: this.colonia,
                                calle: this.calle,
                                numero: this.numero,
                                codigo_postal: this.codigo_postal,
                            }).then(res => {
                                console.log(res);
                            }).catch(err => {
                                console.log(err.response);
                            })
                        } else {
                            console.log('obligame perro')
                        }
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            getMunicipios() {
                this.isMunicipiosReady = false;
                axios.get(route('api.municipios.index', {cve_ent: '23'}))
                    .then(res => {
                        this.municipios = res.data.municipios;
                        this.isMunicipiosReady = true;
                        this.getLocalidades();
                    })
                    .catch(err => {
                        console.log(err.response)
                    })
            },
            getLocalidades() {
                this.isLocalidadesReady = false;
                if(this.hasDomicilio){
                    axios.get(route('api.localidad.index', {cve_ent: this.plantel.domicilio.cve_ent, cve_mun: this.cve_mun}))
                        .then(res => {
                            this.localidades = res.data.localidades;
                            this.isLocalidadesReady = true;
                            this.cveLocSelect2 = {
                                label: this.plantel.domicilio.localidad.NOM_LOC,
                                value: this.plantel.domicilio.cve_loc
                            }
                        })
                        .catch(err => {
                            console.log(err.response);
                        })
                }else{
                    this.isLocalidadesReady = true
                }
            },
            onChangeMunicipio() {
                this.getLocalidades();
            }
        },
        watch: {},
        computed: {
            hasDomicilio() {
                return _.isEmpty(this.plantel.domicilio) ? false : true;
            },
            descripcion() {
                return this.plantel.descripcion;
            },
            cct() {
                return this.plantel.cct;
            },
            telefono() {
                return this.plantel.telefono;
            },
            pagina_web() {
                return this.plantel.pagina_web;
            },
            cve_ent() {
                if (this.plantel.domicilio) {
                    return this.plantel.domicilio.cve_ent;
                } else {
                    return null
                }
            },
            cve_mun() {
                if (this.plantel.domicilio) {
                    return this.plantel.domicilio.cve_mun;
                } else {
                    return null
                }
            },
            cve_loc() {
                if (this.plantel.domicilio) {
                    return this.plantel.domicilio.cve_loc;
                } else {
                    return null
                }
            },
            colonia() {
                if (this.plantel.domicilio) {
                    return this.plantel.domicilio.colonia;
                } else {
                    return null
                }
            },
            calle() {
                if (this.plantel.domicilio) {
                    return this.plantel.domicilio.calle;
                } else {
                    return null
                }
            },
            numero() {
                if (this.plantel.domicilio) {
                    return this.plantel.domicilio.numero;
                } else {
                    return null
                }
            },
            codigo_postal() {
                if (this.plantel.domicilio) {
                    return this.plantel.domicilio.codigo_postal;
                } else {
                    return null
                }
            }
        }
    }
</script>

<style scoped>

</style>
