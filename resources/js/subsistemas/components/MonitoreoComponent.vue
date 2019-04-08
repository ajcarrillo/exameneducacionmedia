<template>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Monitoreo de planteles</h1>
        </div>
        <div class="card-body table-responsive p-0">
            <template v-if="fetchingPlanteles">
                Cargando...
            </template>
            <template v-else>
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="3"></th>
                            <th class="text-center" colspan="5">
                                Aspirantes
                            </th>
                        </tr>
                        <tr>
                            <th>Plantel</th>
                            <th>Municipio</th>
                            <th class="text-right">Oferta</th>
                            <th class="text-right">Demanda</th>
                            <th class="text-right">Con proceso completo</th>
                            <th class="text-right">Con pago</th>
                            <th class="text-right">Sin enviar registro</th>
                            <th class="text-right">Sin pago</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr :key="plantel.id" v-for="plantel in planteles">
                            <td>{{ plantel.plantel }}</td>
                            <td>{{ plantel.municipio }}</td>
                            <td class="text-right">{{ plantel.oferta }}</td>
                            <td class="text-right">{{ plantel.demanda }}</td>
                            <td class="text-right">{{ plantel.proceso_completo }}</td>
                            <td class="text-right">{{ plantel.con_pago }}</td>
                            <td class="text-right">{{ plantel.sin_registro }}</td>
                            <td class="text-right">{{ plantel.con_registro_sin_pago }}</td>
                        </tr>
                    </tbody>
                </table>
            </template>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                planteles: [],
                fetchingPlanteles: false,
            }
        },
        mounted() {
            this.fetchingPlanteles = true;
            axios.get(route('api.subsistema.monitoreo'))
                .then(res => {
                    this.fetchingPlanteles = false;
                    this.planteles = res.data;
                })
                .catch(err => {
                    this.fetchingPlanteles = false
                })
        }
    }
</script>

<style scoped>

</style>
