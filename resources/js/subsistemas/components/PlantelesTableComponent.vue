<template>
    <v-data-table
        :headers="headers"
        :items="items"
        :loading="loading"
        hide-actions
        class="elevation-1">
        <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
        <template slot="items" slot-scope="props">
            <td>{{ props.item.descripcion }}</td>
            <td>{{ props.item.active | estatus }}</td>
            <td v-if="props.item.domicilio">{{ props.item.domicilio.municipio.NOM_MUN }}</td>
            <td v-else>
                <router-link :to="{name:'subsistemas.plantel.domicilio', params:{plantel:props.item.id}}">Agregar domicilio</router-link>
            </td>
            <td v-if="props.item.responsable">{{ props.item.responsable.username }}</td>
            <td v-else>Agregar responsable</td>
            <td class="layout align-center justify-center row fill-height">
                <v-btn small color="primary" @click="aforo(props.item.id)">Aforo</v-btn>
                <v-btn small color="primary" @click="oferta(props.item.id)">Oferta</v-btn>
            </td>
        </template>
        <template slot="no-data">
            El subsistema no tiene planteles asignados
        </template>
    </v-data-table>
</template>

<script>
    export default {
        props: ['items', 'loading'],
        data() {
            return {
                headers: [
                    {text: 'Nombre', align: 'left', sortable: false, value: 'descripcion'},
                    {text: 'Estatus', align: 'left', sortable: false, value: 'active'},
                    {text: 'Municipio', align: 'left', sortable: false, value: ''},
                    {text: 'Responsable', align: 'left', sortable: false, value: ''},
                    {text: 'Acciones', align: 'center', sortable: false, value: 'id'},
                ]
            }
        },
        filters: {
            estatus(value) {
                return value ? 'Activo' : 'Inactivo';
            }
        },
        methods: {
            aforo(id) {
                console.log(id);
            },
            oferta(id) {
                console.log(id);
            }
        }
    }
</script>

<style scoped>

</style>
