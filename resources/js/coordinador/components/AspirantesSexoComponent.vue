<template>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Distribución de aspirantes</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <pie-chart :chartdata="chartData" :options="options"></pie-chart>
                    <div class="d-flex justify-content-around">
                        <div class="">
                            <h4>{{ datos[1].total }} Mujeres</h4>
                        </div>
                        <div class="">
                            <h4>{{ datos[0].total }} Hombres</h4>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="table-responsive" style="font-size: .875rem">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center" colspan="2">Aspirantes por entidad</th>
                                </tr>
                                <tr>
                                    <th class="p-0">Entidad</th>
                                    <th class="text-right p-0">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="entidad in porentidad" :key="entidad.entidad_nacimiento_id">
                                    <td class="p-0">{{ entidad.descripcion}}</td>
                                    <td class="p-0 text-right">{{ entidad.total}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col">
                    <div class="table-responsive" style="font-size: .875rem">
                        <table class="table">
                            <thead>

                                <tr>
                                    <th class="text-center" colspan="2">Aspirantes por país</th>
                                </tr>
                                <tr>
                                    <th class="p-0">País</th>
                                    <th class="text-right p-0">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="pais in porpais" :key="pais.pais_nacimiento_id">
                                    <td class="p-0">{{ pais.pais}}</td>
                                    <td class="p-0 text-right">{{ pais.total}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import PieChart from './PieChartComponent';

    export default {
        components: {
            PieChart
        },
        props: ['datos', 'porentidad', 'porpais'],
        data() {
            return {
                chartData: {
                    labels: _.map(this.datos, 'sexo'),
                    datasets: [
                        {
                            data: _.map(this.datos, 'total'),
                            backgroundColor: ['RGB(53, 162, 235)','RGB(255, 99, 132)']
                        },
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            }
        }
    }
</script>

<style scoped>

</style>
