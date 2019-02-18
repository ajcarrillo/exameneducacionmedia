<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-sm btn-success float-right ml-1" v-if="getState('oferta')==='sr' || getState('oferta')==='C'" @click="enviar('oferta')">
                            <i class="fa fa-arrow-right"></i>
                            Enviar oferta educativa
                        </button>
                        <button type="button" class="btn btn-sm btn-danger float-right ml-1" v-if="getState('oferta')==='C'" @click="motivoRechazo('oferta')">
                            <i class="fa fa-eye"></i>
                            Ver motivo de rechazo oferta
                        </button>
                        <button type="button" class="btn btn-sm btn-warning float-right ml-1" v-if="getState('oferta')==='C'">
                            <i class="fa fa-times"></i>
                            La oferta educativa fue rechazada
                        </button>
                        <button type="button" class="btn btn-sm btn-secondary float-right disabled ml-1" v-if="getState('oferta')==='A'">
                            <i class="fa fa-check"></i>
                            La oferta educativa fue aceptada
                        </button>
                        <button type="button" class="btn btn-sm btn-info float-right disabled ml-1" v-if="getState('oferta')==='R'">
                            <i class="fa fa-file"></i>
                            La oferta educativa esta en revisión
                        </button>

                        <button type="button" class="btn btn-sm btn-success float-right ml-1" v-if="getState('aforo')==='sr' || getState('aforo')==='C'" @click="enviar('aforo')">
                            <i class="fa fa-arrow-right"></i>
                            Enviar aforo
                        </button>
                        <button type="button" class="btn btn-sm btn-danger float-right ml-1" v-if="getState('aforo')==='C'" @click="motivoRechazo('aforo')">
                            <i class="fa fa-eye"></i>
                            ver motivo de rechazo aforo
                        </button>
                        <button type="button" class="btn btn-sm btn-warning float-right ml-1" v-if="getState('aforo')==='C'">
                            <i class="fa fa-times"></i>
                            El aforo fue rechazado
                        </button>
                        <button type="button" class="btn btn-sm btn-secondary float-right disabled ml-1" v-if="getState('aforo')==='A'">
                            <i class="fa fa-check"></i>
                            El aforo fue aceptado
                        </button>
                        <button type="button" class="btn btn-sm btn-info float-right disabled ml-1" v-if="getState('aforo')==='R'">
                            <i class="fa fa-file"></i>
                            El aforo esta en revisión
                        </button>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Plantel</h3>
                        </div>
                        <div class="card-tools">

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
                                    <router-link v-if="getState('oferta')==='sr' || getState('oferta')==='C'"
                                        :to="{name:'subsistema.plantel.oferta', params:{plantelid: props.item.uuid}}">
                                        <button class="btn btn-primary btn-sm">Oferta</button>
                                    </router-link>

                                    <button v-if="getState('oferta')==='R' || getState('oferta')==='A'" @click="isValidForChange('oferta')" class="btn btn-primary btn-sm">Oferta</button>

                                    <router-link v-if="getState('aforo')==='sr' || getState('aforo')==='C'"
                                                 :to="{name:'subsistema.plantel.aforo', params: {plantelid: props.item.uuid}}">
                                        <button class="btn btn-primary btn-sm">Aforo</button>
                                    </router-link>

                                    <button v-if="getState('aforo')==='R' || getState('aforo')==='A'" @click="isValidForChange('aforo')" class="btn btn-primary btn-sm">Aforo</button>

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
            isValidForChange(type = '*') {
                if (type === "*" || type === "aforo") {
                    if (this.getState("aforo") === "R") {
                        this.sweet("El aforo esta en revisión");
                        return 0;
                    }

                    if (this.getState("aforo") === "A") {
                        this.sweet("El aforo ha sido aceptado");
                        return 0;
                    }
                }

                if (type === "*" || type === "oferta") {
                    if (this.getState("oferta") === "R") {
                        this.sweet("La oferta esta en revisión");
                        return 0;
                    }

                    if (this.getState("oferta") === "A") {
                        this.sweet("La oferta ha sido aceptada");
                        return 0;
                    }
                }

                return true;
            },
            updateStatus(plantelId, estatus, index) {

                if (!this.isValidForChange()) {
                    return 0;
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
            rules(tipo) {
                let home = store.state.home;

                if (tipo === 'oferta') {
                    if (!home.isOferta) {
                        this.sweet("La etapa de oferta, no esta aperturada.");
                        return 0;
                    }

                    if (!this.hasActivePlanteles()) {
                        this.sweet("La oferta no tiene planteles activos.")
                        return 0;
                    }

                    if (!this.hasPlantelesActiveOfertas()) {
                        this.sweet('Los planteles, no tienen ofertas educativas activas');
                        return 0;
                    }

                    if (!this.hasPlantelesOfertasGroups()) {
                        this.sweet('Tiene ofertas educativas activas, sin grupos');
                        return 0;
                    }

                } else {
                    if (!home.isAforo) {
                        this.sweet("La etapa de aforo no esta aperturada.");
                        return 0;
                    }

                    if (!this.hasActivePlanteles()) {
                        this.sweet("El aforo no tiene planteles activos.")
                        return 0;
                    }

                    if (!this.hasActivePlantelAulaCapacidad()) {
                        this.sweet("El aforo tiene planteles activos sin capacidad");
                        return 0;
                    }

                }

                return true;
            },
            hasActivePlanteles() {
                let planteles       = store.state.home.planteles,
                    activePlanteles = planteles.filter(plantel => plantel.active || plantel.active === 1);

                if (activePlanteles.length === 0) {
                    return 0;//sin planteles activos no podemos enviar el aforo
                }

                return true;//n planteles activos
            },
            hasActivePlantelAulaCapacidad() {
                let planteles         = store.state.home.planteles,
                    activePlanteles   = planteles.filter(plantel => plantel.active === 1 || plantel.active),
                    aulaPlantel       = activePlanteles.filter(plantel => plantel.aulas.length > 0),
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
            hasPlantelesActiveOfertas() {
                let planteles       = store.state.home.planteles,
                    activePlanteles = planteles.filter(plantel => plantel.active || plantel.active === 1),
                    plantelesOfertas = activePlanteles.filter(plantel => plantel.oferta_educativa.length > 0),
                    plantelesActiveOfertas = plantelesOfertas.filter(plantel => {
                        let activeOfertas = plantel.oferta_educativa.filter(oferta => oferta.active || oferta.active === 1);

                        if (activeOfertas.length > 0) {
                            return plantel;
                        }
                    });

                if (activePlanteles.length !== plantelesOfertas.length) {
                    return 0;
                }

                if (activePlanteles.length !== plantelesActiveOfertas.length) {
                    return 0;
                }

                return true;
            },
            hasPlantelesOfertasGroups() {
                let planteles       = store.state.home.planteles,
                    activePlanteles = planteles.filter(plantel => plantel.active || plantel.active === 1),
                    plantelesOfertas = activePlanteles.filter(plantel => plantel.oferta_educativa.length > 0),
                    plantelesActiveOfertasGroups = plantelesOfertas.filter(plantel => {
                        let activeOfertas = plantel.oferta_educativa.filter(oferta => oferta.active || oferta.active === 1),
                            ofertasWithGroups = activeOfertas.filter(oferta => {
                                if (oferta.grupos !== null && oferta.grupos.grupos > 0) {
                                    return oferta;
                                }
                            });

                        //si existe por lo menos una oferta activa y tiene grupos
                        if (ofertasWithGroups.length > 0) {
                            return plantel;
                        }
                    });

                if (activePlanteles.length !== plantelesActiveOfertasGroups.length) {
                    return 0;
                }

                return true;
            },
            getState(tipo = 'aforo') {
                let state = store.state.home;
                return tipo === 'oferta' ? state.estadoOferta : state.estado;
            },
            enviar(tipo) {
                let title = "",
                    url = "";

                if (!this.rules(tipo)) {
                    return 0;
                }

                if (tipo === 'oferta') {
                    title = "¿Deseas enviar la oferta?";
                    url = "home/storeOfertaRevision";
                } else {
                    title = "¿Deseas enviar el aforo?";
                    url = "home/storeAforoRevision";
                }

                swal.fire({
                    title: title,
                    text: "",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value) {
                        store.dispatch(url)
                            .then(res => {
                                console.log(res);
                            })
                            .catch(err => {
                                this.sweet("Lo sentimos, algo ha salido mal intenta de nuevo", "", "error")
                                console.log(err);
                            })
                    }
                })
            },
            motivoRechazo(tipo) {
                let text = "",
                    revisionAforo = store.state.home.revision_aforos[0].review.comentario,
                    revisionOferta = store.state.home.revision_oferta[0].review.comentario;

                text = tipo === 'oferta' ? revisionOferta : revisionAforo;

                swal.fire({
                    type: 'info',
                    title: 'Motivo de rechazo.',
                    text: text,
                    footer: ''
                })
            },
            sweet(text = "", title = "", type = "info") {
                swal.fire({
                    type: type,
                    title: title,
                    text: text,
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
