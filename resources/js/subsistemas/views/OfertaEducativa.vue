<template>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <button @click="$modal.show('create-oferta')" class="btn btn-primary">
                        <i class="fa fa-plus"></i>&nbsp;Agregar
                    </button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">Oferta educativa</h1>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-unstyled" id="ofertas-list">
                                <oferta-card :key="o.id" :oferta="o" v-for="o in oferta"></oferta-card>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <create :plantelid="plantelId"></create>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import store from '../store/store';
    import Create from '../components/oferta/CreateComponent'
    import OfertaCard from '../components/oferta/OfertaCardComponent';

    export default {
        name: "OfertaEducativa",
        components: {
            Create,
            OfertaCard
        },
        props: [],
        data() {
            return {}
        },
        computed: {
            oferta() {
                return store.state.oferta.oferta;
            },
            plantelId() {
                return this.$route.params.plantelid;
            }
        },
        beforeRouteEnter(to, from, next) {
            store.dispatch('oferta/getOferta')
                .then(res => {
                    next();
                });
        },
        beforeRouteUpdate(to, from, next) {
            store.dispatch('oferta/getOferta')
                .then(res => {
                    next();
                });
        },
    }
</script>

<style scoped>
    #ofertas-list li {
        border-top: 1px solid RGBA(222, 226, 230, 1.00);
        border-bottom: 1px solid RGBA(222, 226, 230, 1.00);
    }

    #ofertas-list li:first-child {
        border-top: 0;
    }

    #ofertas-list li:last-child {
        border-bottom: 0;
    }
</style>
