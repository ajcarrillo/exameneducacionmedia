<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 offset-4">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Asignar responsable</h1>
                    </div>
                    <div class="card-body">
                        <responsable-form
                            :plantelid="uuid"
                        ></responsable-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ResponsableForm from '../components/ResponsableFormComponent';

    export default {
        name: "Responsable",
        components: {
            ResponsableForm
        },
        props: [],
        data() {
            return {}
        },
        computed:{
            uuid(){
                return this.$route.params.plantelid;
            }
        },
        methods: {},
    }
</script>

<style scoped>

</style>
