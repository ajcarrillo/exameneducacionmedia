<template>
    <v-container fluid>
        <v-layout row>
            <v-flex md12>
                <planteles-table :items="planteles" :loading="loadingData"></planteles-table>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import store from '../store';
    import PlantelesTable from '../components/PlantelesTableComponent'

    export default {
        components: {PlantelesTable},
        data() {
            return {
                message: 'subsistema',
                loadingData: true,
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
        }
    }
</script>

<style scoped>

</style>
