<template>
    <v-container fluid>
        <v-layout row>
            <v-flex md-12>
                <h1>{{ plantelActual }}</h1>
            </v-flex>
        </v-layout>
        <v-layout row>
            <v-flex md6>
                <v-card>
                    <v-card-title class="headline font-weight-regular blue darken-3 white--text">Domicilio</v-card-title>
                    <v-card-text>
                        <domicilio-form :municipios="municipios" :plantel="plantel"></domicilio-form>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import DomicilioForm from '../../components/DomicilioFormComponent'
    import store from '../store';

    export default {
        props: ['plantel'],
        components: {DomicilioForm},
        data() {
            return {
                municipios: [],
            }
        },
        created() {
            axios.get(route('api.municipios.index', {municipio_id: '23'}))
                .then(res => {
                    this.municipios = res.data.municipios
                })
                .catch(err => {
                    console.log(err);
                })
        },
        computed: {
            plantelActual() {
                let plantelId = this.plantel;
                let plantel = _.filter(store.state.planteles, function (item) {
                    return item.id == plantelId;
                });

                return plantel[0].descripcion;
            }
        }
    }
</script>

<style scoped>

</style>
