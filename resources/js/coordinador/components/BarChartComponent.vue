<script>
    import {Bar} from 'vue-chartjs'

    export default {
        extends: Bar,
        props: {
            chartdata: {
                type: Object,
                default: null
            },
            options: {
                type: Object,
                default: null
            }
        },
        mounted() {
            this.options.animation = {
                onComplete: function () {
                    let chartInstance = this.chart;
                    let ctx = chartInstance.ctx;
                    ctx.fillStyle = "#000";
                    ctx.textAlign = "right";

                    Chart.helpers.each(this.data.datasets.forEach(function (dataset, i) {
                        let meta = chartInstance.controller.getDatasetMeta(i);
                        Chart.helpers.each(meta.data.forEach(function (bar, index) {
                            let number = parseInt(dataset.data[index]);
                            ctx.fillText(number.toLocaleString('en'), bar._model.x + 20, bar._model.y - 6);
                        }), this)
                    }), this);
                }
            };
            this.renderChart(this.chartdata, this.options)
        }
    }
</script>

<style scoped>

</style>
