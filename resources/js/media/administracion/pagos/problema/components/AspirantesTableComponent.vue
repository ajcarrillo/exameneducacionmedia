<template>
    <table class="table">
        <thead>
            <tr>
                <th>Folio</th>
                <th>CURP</th>
                <th>Mátricula</th>
                <th>Nombre</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <tr :key="aspirante.id" v-for="aspirante in aspirantes">
                <td class="align-middle">{{ aspirante.aspirante.folio }}</td>
                <td class="align-middle">{{ aspirante.aspirante.curp }}</td>
                <td class="align-middle">{{ aspirante.aspirante.matricula }}</td>
                <td class="align-middle">{{ `${aspirante.nombre} ${aspirante.primer_apellido} ${aspirante.segundo_apellido}` }}</td>
                <td>
                    <button @click="asignarPago" class="btn btn-primary btn-sm" type="button">Asignar pago</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    import store from '../../store/store';

    export default {
        computed: {
            aspirantes() {
                return store.state.aspirantes.users ? store.state.aspirantes.users.data : [];
            }
        },
        methods: {
            asignarPago() {
                swal({
                    title: '¿Estás seguro?',
                    text: "¡Esta acción no se pude deshacer!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, estoy seguro!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value) {
                        store.dispatch('asignarPago', {});
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
