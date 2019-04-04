<template>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">
                Subsistemas con demanda y oferta
            </h1>
        </div>
        <div class="card-body">
            <bar-chart :chartdata="chartData" :options="options"></bar-chart>
        </div>
    </div>
</template>

<script>
    import BarChart from './BarChartComponent';

    export default {
        components: {
            BarChart
        },
        props: ['datos'],
        computed: {
            labels() {
                return _.map(this.datos, 'referencia')
            },
            demanda() {
                return _.map(this.datos, 'demanda')
            },
            oferta() {
                return _.map(this.datos, 'oferta')
            }
        },
        data() {
            return {
                chartData: {
                    labels: _.map(this.datos, 'referencia'),
                    datasets: [
                        {
                            label: 'Oferta',
                            backgroundColor: 'RGB(255, 99, 132)',
                            borderColor: 'RGB(255, 99, 132)',
                            data: _.map(this.datos, 'oferta')
                        },
                        {
                            label: 'Demanda',
                            backgroundColor: 'RGB(53, 162, 235)',
                            borderColor: 'RGB(53, 162, 235)',
                            data: _.map(this.datos, 'demanda')
                        }
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
