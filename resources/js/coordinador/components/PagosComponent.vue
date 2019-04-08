<template>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Solicitudes de pago</h1>
        </div>
        <div class="card-body">
            <template v-if="!ready">
                Cargando...
            </template>
            <template v-else>
                <bar-chart :chartdata="chartData" :options="options"></bar-chart>
                <div class="row text-center mt-3">
                    <div class="col">
                        <h4>
                            <span class="d-block">${{ pagos.monto_total.toLocaleString('en') }}</span>
                            <span>Monto total</span>
                        </h4>
                    </div>
                    <div class="col">
                        <h4>
                            <span class="d-block">${{ pagos.monto_pagadas.toLocaleString('en') }}</span>
                            <span>Monto pagado</span>
                        </h4>
                    </div>
                    <div class="col">
                        <h4>
                            <span class="d-block">${{ pagos.monto_sin_pago.toLocaleString('en') }}</span>
                            <span>Monto por pagar</span>
                        </h4>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
    import BarChart from './BarChartComponent'

    export default {
        components: {
            BarChart,
        },
        data() {
            return {
                pagos: {},
                ready: false,
                chartData: {
                    labels: ['Solicitudes', 'Pagadas', 'Por pagar'],
                    datasets: [
                        {
                            backgroundColor: [
                                'RGB(53, 162, 235)',
                                'RGB(255, 99, 132)',
                                'RGB(255, 205, 86)'
                            ],
                            borderColor: [
                                'RGB(53, 162, 235)',
                                'RGB(255, 99, 132)',
                                'RGB(255, 205, 86)'
                            ],
                            data: []
                        },
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend:{
                        display: false
                    }
                }
            }
        },
        mounted() {
            axios.get(route('api.pagos.index'))
                .then(res => {
                    this.pagos = res.data;
                    this.chartData.datasets[0].data[0] = this.pagos.total;
                    this.chartData.datasets[0].data[1] = this.pagos.solicitudes_pagadas;
                    this.chartData.datasets[0].data[2] = this.pagos.solicitudes_sin_pago;
                    this.ready = true;
                })
        }
    }
</script>

<style scoped>

</style>
