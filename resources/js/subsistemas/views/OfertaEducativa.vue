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

    export default {
        name: "OfertaEducativa",
        components: {
            Create
        },
        props: [],
        data() {
            return {

            }
        },
        computed: {
            oferta() {
                return store.state.oferta.oferta;
            },
            plantelId(){
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

</style>
