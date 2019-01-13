<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">
                            Especialidades
                        </h1>
                        <create></create>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="30%">Nombre</th>
                                    <th width="">Descripción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="especialidad in especialidades">
                                    <tr>
                                        <edit :especialidad="especialidad"></edit>
                                        <td>
                                            <span v-text="especialidad.descripcion"></span>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import store from '../store/store';
    import Create from '../components/especialidades/CreateComponent'
    import Edit from '../components/especialidades/EditComponent';

    export default {
        name: "Especialidad",
        components: {
            Create,
            Edit
        },
        props: [],
        data() {
            return {}
        },
        computed: {
            especialidades() {
                return store.state.especialidad.especialidades;
            }
        },
        methods: {
            update() {
            },
            save() {
            }
        },
        beforeRouteEnter(to, from, next) {
            store.dispatch('especialidad/getEspecialidades')
                .then(res => {
                    next();
                })
                .catch(err => {
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Lo sentimos, algo ha salido mal intenta de nuevo',
                    })
                    console.log(err.response);
                })
        },
        beforeRouteUpdate(to, from, next) {
            store.dispatch('especialidad/getEspecialidades')
                .then(res => {
                    next();
                })
                .catch(err => {
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Lo sentimos, algo ha salido mal intenta de nuevo',
                    })
                    console.log(err.response);
                })
        },
    }
</script>

<style scoped>

</style>
