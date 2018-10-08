<template>
    <div class="container-fluid">
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
                                <input type="text" class="form-control" :class="{'input': true, 'has-error': errors.has('descripcion') }" name="descripcion" v-model="descripcion" autofocus v-validate="'required'">
                                <div class="input-has-error">{{ errors.first('descripcion') }}</div>
                            </div>
                            <div class="form-group">
                                <label for="">CCT</label>
                                <input type="text" class="form-control" :class="{'input': true, 'has-error': errors.has('cct') }" name="cct" v-model="cct" v-validate="'required'">
                                <div class="input-has-error">{{ errors.first('cct') }}</div>
                            </div>
                            <div class="form-group">
                                <label for="">Teléfono</label>
                                <input type="text" class="form-control" :class="{'input': true, 'has-error': errors.has('telefono') }" name="telefono" v-model="telefono" v-validate="'required'">
                                <div class="input-has-error">{{ errors.first('telefono') }}</div>
                            </div>
                            <div class="form-group">
                                <label for="">Página web</label>
                                <input type="text" class="form-control" :class="{'input': true, 'has-error': errors.has('pagina') }" name="pagina" v-model="pagina" placeholder="http://www.example.com" v-validate="'required|url'">
                                <div class="input-has-error">{{ errors.first('pagina') }}</div>
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
                            <div class="form-group">
                                <label for="">Municipio</label>
                                <municipio cve-ent="23" v-model="cve_mun" name="cve_mun" v-validate="'required'" :class="{'input': true, 'has-error': errors.has('cve_mun') }"></municipio>
                                <div class="input-has-error">{{ errors.first('cve_mun') }}</div>
                            </div>
                            <div class="form-group">
                                <label for="">Localidad</label>
                                <localidad :entidad="23" :municipio="cve_mun" v-model="cve_loc" name="cve_loc" v-validate="'required'" :class="{'input': true, 'has-error': errors.has('cve_loc') }"></localidad>
                                <div class="input-has-error">{{ errors.first('cve_loc') }}</div>
                            </div>
                            <div class="form-group">
                                <label for="">Calle</label>
                                <input type="text" class="form-control" v-model="calle" name="calle" :class="{input:true, 'has-error':errors.has('calle')}" v-validate="'required'">
                                <div class="input-has-error">{{ errors.first('calle') }}</div>
                            </div>
                            <div class="form-group">
                                <label for="">Número</label>
                                <input type="text" class="form-control" v-model="numero" name="numero" :class="{input:true, 'has-error':errors.has('numero')}" v-validate="'required'">
                                <div class="input-has-error">{{ errors.first('numero') }}</div>
                            </div>
                            <div class="form-group">
                                <label for="">Colonia</label>
                                <input type="text" class="form-control" v-model="colonia" name="colonia" :class="{input:true, 'has-error':errors.has('colonia')}" v-validate="'required'">
                                <div class="input-has-error">{{ errors.first('colonia') }}</div>
                            </div>
                            <div class="form-group">
                                <label for="">Código postal</label>
                                <input type="text" class="form-control" v-model="codigo_postal">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h1 class="card-title">Responsable</h1>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" class="form-control" v-model="nombre" name="nombre" :class="{input:true, 'has-error':errors.has('nombre')}" v-validate="'required'">
                                <div class="input-has-error">{{ errors.first('nombre')}}</div>
                            </div>
                            <div class="form-group">
                                <label for="">Primer apellido</label>
                                <input type="text" class="form-control" v-model="primer_apellido" name="primer_apellido" :class="{input:true, 'has-error':errors.has('primer_apellido')}" v-validate="'required'">
                                <div class="input-has-error">{{ errors.first('primer_apellido')}}</div>
                            </div>
                            <div class="form-group">
                                <label for="">Segundo apellido</label>
                                <input type="text" class="form-control" v-model="segundo_apellido">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" v-model="email" name="email" :class="{input:true, 'has-error':errors.has('email')}" v-validate="'required|email'">
                                <div class="input-has-error">{{ errors.first('email')}}</div>
                            </div>
                            <div class="form-group">
                                <label for="">Usuario</label>
                                <input type="text" class="form-control" v-model="username" name="username" :class="{input:true, 'has-error':errors.has('username')}" v-validate="'required'">
                                <div class="input-has-error">{{ errors.first('username')}}</div>
                            </div>
                            <div class="form-group">
                                <label for="">Contraseña</label>
                                <input type="text" class="form-control" v-model="password" name="password" :class="{input:true, 'has-error':errors.has('password')}" v-validate="'required'">
                                <div class="input-has-error">{{ errors.first('password')}}</div>
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
    </div>
</template>

<script>
    import municipio from '../../components/MunicipioFieldComponent'
    import localidad from '../../components/LocalidadFieldComponent'

    export default {
        components: {municipio, localidad},
        data() {
            return {
                descripcion: null,
                cct: null,
                telefono: null,
                pagina: null,
                cve_ent: '23',
                cve_mun: null,
                cve_loc: null,
                colonia: null,
                calle: null,
                numero: null,
                codigo_postal: null,
                nombre: null,
                primer_apellido: null,
                segundo_apellido: null,
                email: null,
                username: null,
                password: null,
                dictionary: {
                    custom: {
                        descripcion: {
                            required: 'El nombre es requerido'
                        },
                        cct: {
                            required: 'La clave de centro de trabajo es requerida'
                        },
                        telefono: {
                            required: 'El teléfono es requerido'
                        },
                        pagina: {
                            required: 'La página web es requerida',
                            url: 'La dirección url no tiene el formato correcto',
                        },
                        cve_mun: {
                            required: 'El municipio es requerido'
                        },
                        cve_loc: {
                            required: 'La localidad es requerida'
                        },
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
        watch: {},
        mounted() {
            this.$validator.localize('es', this.dictionary)
        },
        methods: {
            submit() {
                this.$validator.validate()
                    .then(isValid => {
                        if (isValid) {
                            axios.post(route('api.subsistema.plantel.store'), {
                                descripcion: this.descripcion,
                                cct: this.cct,
                                telefono: this.telefono,
                                pagina: this.pagina,
                                cve_ent: this.cve_ent,
                                cve_mun: this.cve_mun,
                                cve_loc: this.cve_loc,
                                colonia: this.colonia,
                                calle: this.calle,
                                numero: this.numero,
                                codigo_postal: this.codigo_postal,
                                nombre: this.nombre,
                                primer_apellido: this.primer_apellido,
                                segundo_apellido: this.segundo_apellido,
                                email: this.email,
                                username: this.username,
                                password: this.password,
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
            }
        }
    }
</script>

<style scoped>

</style>
