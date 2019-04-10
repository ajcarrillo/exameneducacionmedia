<template>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Monitoreo de especialidades</h1>
            <p class="mb-0">Especialidades que eligieron los aspirantes como primera opción</p>
        </div>
        <div class="card-body" v-if="fetchingEspecialidades">
            Cargando...
        </div>
        <div class="card-body p-0 table-responsive" v-else>
            <table class="table">
                <thead>
                    <tr>
                        <th>Municipio</th>
                        <th>Plantel</th>
                        <th>Especialidad</th>
                        <th class="text-right">Aspirantes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="especialidad in especialidades">
                        <td scope="row">{{ especialidad.municipio }}</td>
                        <td>{{ especialidad.descripcion }}</td>
                        <td>{{ especialidad.referencia }}</td>
                        <td class="text-right">{{ especialidad.aspirantes }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                especialidades: [],
                fetchingEspecialidades: false,
            }
        },
        mounted() {
            this.fetchingEspecialidades = true;
            let subsistemaId = document.head.querySelector('meta[name="subsistema"]');

            axios.get(route('api.subsistema.monitoreo.especialidades'), {
                params: {
                    subsistemaid: subsistemaId.content
                }
            }).then(res => {
                this.especialidades = res.data.especialidades;
                this.fetchingEspecialidades = false;
            }).catch(err => {

                this.fetchingEspecialidades = false;
            });
        }
    }
</script>

<style scoped>

</style>
