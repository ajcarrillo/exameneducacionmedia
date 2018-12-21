<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Plantel</h3>
                            <router-link :to="{name:'subsistemas.plantel'}">
                                <a>Nuevo plantel</a>
                            </router-link>
                        </div>
                    </div>
                    <div class="card-body p-0 table-responsive">
                        <planteles-table :items="planteles" :headers="headers">
                            <template slot="items" slot-scope="props">
                                <td>
                                    <router-link :to="{name:'subsistemas.plantel.edit', params:{plantelId:props.item.id}}">
                                        <a data-toggle="tooltip" data-placement="top" title="Click para editar"><i class="fa fa-pen"></i></a>
                                    </router-link>
                                </td>
                                <td>{{ props.item.descripcion }}</td>
                                <td>
                                    <button @click="updateStatus(props.item.id, props.item.active, props.index)" class="btn btn-link" data-toggle="tooltip" data-placement="top"
                                            :title="props.item.active|buttonTitle">
                                        <active-plantel :active="props.item.active"></active-plantel>
                                    </button>
                                </td>
                                <td>
                                    {{ props.item.municipio.NOM_MUN }}
                                </td>
                                <td v-if="props.item.responsable">{{ props.item.responsable.nombre_completo }}</td>
                                <td v-else>
                                    <button class="btn btn-primary btn-sm" @click="showFormAsignarRes(props.item, props.index)">Asignar</button>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary btn-sm">Aforo</button>
                                    <button class="btn btn-primary btn-sm">Oferta</button>
                                </td>
                            </template>
                        </planteles-table>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-responsible-container" ref="box">
            <form @submit.prevent="submit">
                <div class="card border-bottom-0 card-primary" style="margin-bottom: 0!important; border-bottom-left-radius: 0; border-bottom-right-radius: 0">
                    <div class="card-header">
                        <h1 class="card-title">Asignar responsable al plantel</h1>
                        <div class="card-tools">
                            <button class="btn btn-tool btn-sm" @click="closeFormAsignarRes">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" v-model="responsable.nombre" name="nombre" :class="{input:true, 'has-error':errors.has('nombre')}" v-validate="'required'" autofocus>
                            <div class="input-has-error">{{ errors.first('nombre')}}</div>
                        </div>
                        <div class="form-group">
                            <label for="">Primer apellido</label>
                            <input type="text" class="form-control" v-model="responsable.primer_apellido" name="primer_apellido" :class="{input:true, 'has-error':errors.has('primer_apellido')}" v-validate="'required'">
                            <div class="input-has-error">{{ errors.first('primer_apellido')}}</div>
                        </div>
                        <div class="form-group">
                            <label for="">Segundo apellido</label>
                            <input type="text" class="form-control" v-model="responsable.segundo_apellido" name="segundo_apellido">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" v-model="responsable.email" name="email" :class="{input:true, 'has-error':errors.has('email')}" v-validate="'required|email'">
                            <div class="input-has-error">{{ errors.first('email')}}</div>
                        </div>
                        <div class="form-group">
                            <label for="">Usuario</label>
                            <input type="text" class="form-control" v-model="responsable.username" name="username" :class="{input:true, 'has-error':errors.has('username')}" v-validate="'required'">
                            <div class="input-has-error">{{ errors.first('username')}}</div>
                        </div>
                        <div class="form-group">
                            <label for="">Contraseña</label>
                            <input type="text" class="form-control" v-model="responsable.password" name="password" :class="{input:true, 'has-error':errors.has('password')}" v-validate="'required'">
                            <div class="input-has-error">{{ errors.first('password')}}</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Asignar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</template>

<script>
    import Vue from 'vue';
    import store from '../store/store';
    import PlantelesTable from '../../components/TableComponent'
    import {TimelineLite, Elastic, Circ, Expo} from 'gsap';

    Vue.component('active-plantel', {
        template: '<i :class="classObject"></i>',
        props: ['active'],
        data() {
            return {}
        },
        computed: {
            classObject() {
                return {
                    'fas fa-times text-danger': this.active,
                    'fas fa-check text-success': !this.active,
                }
            }
        }
    });
    export default {
        components: {PlantelesTable},
        data() {
            return {
                message: 'subsistema',
                loadingData: true,
                responsable: {
                    plantelId: null,
                    plantelIndex: null,
                    nombre: 'Carlos',
                    primer_apellido: 'Perez',
                    segundo_apellido: 'Lopez',
                    email: 'perez@gmai.com',
                    username: 'plope',
                    password: '123456',
                },
                headers: [
                    {text: '', value: '', align: 'left', width: '1%'},
                    {text: 'Plantel', value: 'descripcion', align: 'left'},
                    {text: 'Estatus', value: 'active', align: 'left'},
                    {text: 'Municipio', value: '', align: 'left'},
                    {text: 'Responsable', value: 'responsable_id', align: 'left'},
                    {text: 'Opciones', value: '', align: 'center'},
                ],
                dictionary: {
                    custom: {
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
        computed: {
            totalPlanteles() {
                return store.state.home.planteles.length;
            },
            totalEspecialidades() {
                return store.state.home.especialidades.length;
            },
            planteles() {
                return store.state.home.planteles;
            },
            especialidades() {
                return store.state.home.especialidades;
            }
        },
        created() {
            let subsistema = document.head.querySelector('meta[name="subsistema"]');
            store.dispatch('home/getData', subsistema.content)
                .then(res => {
                    this.loadingData = false;
                });
        },
        filters: {
            sino(value) {
                return value ? 'Activo' : 'Inactivo';
            },
            buttonTitle(value) {
                return value ? 'Click para inhabilitar' : 'Click para habilitar';
            }
        },
        methods: {
            submit() {
                //Asigar responsable
                this.$validator.validate()
                    .then(isValid => {
                        if (isValid) {
                            store.dispatch('home/asignarResponsable', {responsable: this.responsable})
                                .then(res => {
                                    this.closeFormAsignarRes();
                                })
                                .catch(err => {

                                })
                        } else {

                        }
                    })
                    .catch(err => {

                    })
            },
            closeFormAsignarRes() {
                this.responsable.plantelId = null;
                const {box} = this.$refs;
                const timeline = new TimelineLite();
                timeline.to(box, 0.5, {ease: Expo.easeOut, y: 666})
            },
            showFormAsignarRes(plantel, index) {
                this.responsable.plantelId = plantel.id;
                this.responsable.plantelIndex = index;
                const {box} = this.$refs;
                const timeline = new TimelineLite();
                timeline.to(box, 0.5, {ease: Expo.easeOut, y: -666})
            },
            updateStatus(plantelId, estatus, index) {
                if (estatus) {
                    //desactivar
                    store.dispatch('home/desactivarPlantel', {plantel: plantelId, index: index})
                        .then(res => {
                            console.log(res);
                        })
                        .catch(err => {
                            console.log(err);
                        })
                } else {
                    //activar
                    store.dispatch('home/activarPlantel', {plantel: plantelId, index: index})
                        .then(res => {
                            console.log(res);
                        })
                        .catch(err => {
                            console.log(err);
                        })
                }
            }
        }
    }
</script>

<style scoped>
    .form-responsible-container {
        bottom: -666px;
        position: fixed;
        width: 40%;
        max-width: 360px;
        min-width: 360px;
        left: 50%;
        margin-left: -20.5%;
        border-radius: .25rem;
        border: 0 solid rgba(0, 0, 0, .125);
    }

    .form-content {
        background-color: white;
        padding: 20px;
    }
</style>
