<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Plantel</h3>
                        </div>
                        <div class="card-tools col-sm-5">
                            <button type="button" class="btn btn-sm btn-success float-right ml-1" v-if="getState()==='sr' || getState()==='C'" @click="enviarAforo()">
                                <i class="fa fa-arrow-right"></i>
                                Enviar aforo
                            </button>
                            <button type="button" class="btn btn-sm btn-danger float-right ml-1" v-if="getState()==='C'" @click="motivoRechazo">
                                <i class="fa fa-eye"></i>
                                Ver motivo de rechazo
                            </button>
                            <button type="button" class="btn btn-sm btn-info float-right disabled ml-1" v-if="getState()==='C'">
                                El aforo fue rechazado
                            </button>
                            <button type="button" class="btn btn-sm btn-info float-right disabled ml-1" v-if="getState()==='A'">
                                El aforo ha sido aceptado
                            </button>
                            <button type="button" class="btn btn-sm btn-info float-right disabled ml-1" v-if="getState()==='R'">
                                El aforo esta en revisión
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0 table-responsive">
                        <planteles-table :items="planteles" :headers="headers">
                            <template slot="items" slot-scope="props">
                                <td colspan="2">
                                    <edit-name-form
                                        :plantelid="props.item.id"
                                        :plantelname="props.item.descripcion"
                                        @submit="updateName"
                                    ></edit-name-form>
                                </td>
                                <td>
                                    <button :data-tooltip-title="props.item.active|buttonTitle"
                                            @click="updateStatus(props.item.id, props.item.active, props.index)"
                                            class="btn btn-link" v-tooltip:top="">
                                        <active-plantel :active="props.item.active"></active-plantel>
                                    </button>
                                </td>
                                <td>
                                    {{ props.item.municipio.NOM_MUN }}
                                </td>
                                <td v-if="props.item.responsable">{{ props.item.responsable.nombre_completo }}</td>
                                <td v-else>
                                    <router-link
                                        :to="{name:'subsistema.plantel.responsable', params:{plantelid: props.item.uuid}}">
                                        <button class="btn btn-primary btn-sm">Asignar</button>
                                    </router-link>
                                </td>
                                <td class="text-center">
                                    <router-link
                                        :to="{name:'subsistema.plantel.oferta', params:{plantelid: props.item.uuid}}">
                                        <button class="btn btn-primary btn-sm">Oferta</button>
                                    </router-link>

                                    <router-link v-if="getState()==='sr' || getState()==='C'"
                                        :to="{name:'subsistema.plantel.aforo', params: {plantelid: props.item.uuid}}">
                                        <button class="btn btn-primary btn-sm">Aforo</button>
                                    </router-link>

                                    <button v-if="getState()==='R' || getState()==='A'" @click="mensaje(getState())" class="btn btn-primary btn-sm">Aforo</button>

                                </td>
                            </template>
                        </planteles-table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import Vue from 'vue';
    import store from '../store/store';
    import PlantelesTable from '../../components/TableComponent'
    import MyTooltip from '../../directives/TooltipDirective'
    import EditNameForm from '../components/EditPlantelNameFormComponent';
    import Swal from 'sweetalert2';

    Vue.directive('tooltip', MyTooltip);

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
        components: {
            PlantelesTable,
            EditNameForm
        },
        data() {
            return {
                message: 'subsistema',
                loadingData: true,
                headers: [
                    {text: '', value: '', align: 'left', width: '1%'},
                    {text: 'Plantel', value: 'descripcion', align: 'left'},
                    {text: 'Estatus', value: 'active', align: 'left'},
                    {text: 'Municipio', value: '', align: 'left'},
                    {text: 'Responsable', value: 'responsable_id', align: 'left'},
                    {text: 'Opciones', value: '', align: 'center'},
                ],
            }
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
            },
            estado() {
                return store.state.home.estado;
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
            updateStatus(plantelId, estatus, index) {

                if (this.getState()==='R' || this.getState()==='A') {
                    this.mensaje(this.getState());
                    return true;
                }

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
            },
            updateName(payload) {

                let index = this.planteles.findIndex(function (el) {
                    return el.id == payload.id
                });

                store.dispatch('home/actualizaNombre', {index: index, draft: payload.draft})

                this.$notify({
                    group: 'notify',
                    title: 'Notificaciones',
                    text: 'El nombre del plantel se actualizó correctamente',
                    type: 'success'
                });
            },
            rules() {
                let home = store.state.home;

                if (!home.isAforo) {
                    this.mensaje('aforo');
                    return 0;
                }

                if (!this.hasActivePlanteles()) {
                    this.mensaje('plantel')
                    return 0;
                }

                if (!this.hasActivePlantelAulaCapacidad()) {
                    this.mensaje('capacidad');
                    return 0;
                }

                return true;
            },
            hasActivePlanteles() {
                let planteles = store.state.home.planteles,
                    activePlanteles = planteles.filter(plantel => plantel.active || plantel.active === 1);

                if (activePlanteles.length === 0) {
                    return 0;//sin planteles activos no podemos enviar el aforo
                }

                return true;//n planteles activos
            },
            hasActivePlantelAulaCapacidad() {
                let planteles = store.state.home.planteles,
                    activePlanteles = planteles.filter(plantel => plantel.active === 1 || plantel.active),
                    aulaPlantel = activePlanteles.filter(plantel => plantel.aulas.length > 0),
                    hasAulasCapacidad = activePlanteles.filter(plantel => {
                        let hasAulasCapacidad = plantel.aulas.filter(aula => aula.capacidad > 0);

                        if (hasAulasCapacidad.length > 0) {
                            return plantel;
                        }
                    });

                if (activePlanteles.length !== aulaPlantel.length) {
                    return 0; //cada plantel activo debe tener un aula por lo menos
                }

                if (activePlanteles.length !== hasAulasCapacidad.length) {
                    return 0; //cada plantel activo con aulas, debe tener minimo un aula con capacidad
                }

                return true;
            },
            getState() {
                return store.state.home.estado;
            },
            enviarAforo() {

                if (!this.rules()) {
                    return 0;
                }

                Swal.fire({
                    title: '¿Deseas enviar el aforo?',
                    text: "",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value) {
                        store.dispatch('home/storeRevision')
                            .then(res => {
                                console.log(res);
                            })
                            .catch(err => {
                                this.mensaje('error', 'Lo sentimos, algo ha salido mal intenta de nuevo.')
                                console.log(err);
                            })
                    }
                })
            },
            motivoRechazo() {
                Swal.fire({
                    type: 'info',
                    title: 'Motivo de rechazo.',
                    text: store.state.home.revision_aforos[0].review.comentario,
                    footer: ''
                })
            },
            mensaje(tipo, msj) {
                let mensaje = "",
                    type = "info";

                switch (tipo) {
                    case 'R':
                    mensaje = "El aforo esta en revisión.";
                    break;
                    case 'A':
                        mensaje = "El aforo ha sido aceptado.";
                        break;
                    case 'plantel':
                        mensaje = "El aforo no tiene planteles activos.";
                        break;
                    case 'aforo':
                        mensaje = "La etapa de aforo no esta aperturada.";
                        break;
                    case 'capacidad':
                        mensaje = "El aforo tiene planteles activos sin capacidad";
                        break;
                    case 'error':
                        mensaje = msj;
                        type = "error";
                        break;
                    default:
                        mensaje= " ";

                }

                Swal.fire({
                    type: type,
                    title: '',
                    text: mensaje,
                    footer: ''
                })
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
