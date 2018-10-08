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
                                    <router-link :to="{name:'subsistemas.plantel.edit', params:{id:props.item.id}}">
                                        <a><i class="fa fa-pen"></i></a>
                                    </router-link>
                                </td>
                                <td>{{ props.item.descripcion }}</td>
                                <td>{{ props.item.active|sino }}</td>
                                <td v-if="props.item.domicilio">{{ props.item.domicilio.municipio.NOM_MUN }}</td>
                                <td v-else>Agregar domicilio</td>
                                <td v-if="props.item.responsable">{{ props.item.responsable.nombre_completo }}</td>
                                <td v-else>Agregar responsable</td>
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
    </div>

</template>

<script>
    import store from '../store';
    import PlantelesTable from '../../components/TableComponent'

    export default {
        components: {PlantelesTable},
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
                ]
            }
        },
        computed: {
            totalPlanteles() {
                return store.state.planteles.length;
            },
            totalEspecialidades() {
                return store.state.especialidades.length;
            },
            planteles() {
                return store.state.planteles;
            },
            especialidades() {
                return store.state.especialidades;
            }
        },
        created() {
            let subsistema = document.head.querySelector('meta[name="subsistema"]');
            store.dispatch('getData', subsistema.content)
                .then(res => {
                    this.loadingData = false;
                });
        },
        filters: {
            sino(value) {
                return value ? 'Activo' : 'Inactivo';
            }
        },
        methods: {
            editar(plantelId) {
                this.$router.push({name: 'subsistemas.plantel'});
            }
        }
    }
</script>

<style scoped>

</style>
