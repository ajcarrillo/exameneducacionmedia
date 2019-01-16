<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Plantel</h3>
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
                                    <button :data-tooltip-title="props.item.active|buttonTitle" @click="updateStatus(props.item.id, props.item.active, props.index)"
                                            class="btn btn-link" v-tooltip:top="">
                                        <active-plantel :active="props.item.active"></active-plantel>
                                    </button>
                                </td>
                                <td>
                                    {{ props.item.municipio.NOM_MUN }}
                                </td>
                                <td v-if="props.item.responsable">{{ props.item.responsable.nombre_completo }}</td>
                                <td v-else>
                                    <router-link :to="{name:'subsistema.plantel.responsable', params:{plantelid: props.item.uuid}}">
                                        <button class="btn btn-primary btn-sm">Asignar</button>
                                    </router-link>
                                </td>
                                <td class="text-center">
                                    <router-link :to="{name:'subsistema.plantel.oferta', params:{plantelid: props.item.uuid}}">
                                        <button class="btn btn-primary btn-sm">Oferta</button>
                                    </router-link>

                                    <router-link :to="{name:'subsistema.plantel.aforo', params: {plantelid: props.item.uuid}}">
                                        <button class="btn btn-primary btn-sm">Aforo</button>
                                    </router-link>

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
