<template>
    <form @submit.prevent="save">
        <div class="form-group">
            <label for="">Clave centro de trabajo</label>
            <input class="form-control" name="clave_centro_trabajo" type="text" v-model="draft.clave_centro_trabajo">
            <small class="text-muted">La clave la puedes encontrar en tu boleta de calificaciones y siempre empieza con un número 23</small>
        </div>
        <div class="form-group">
            <label for="">Nombre centro trabajo</label>
            <input class="form-control" name="nombre_centro_trabajo" required type="text" v-model="draft.nombre_centro_trabajo">
        </div>
        <div class="form-group">
            <label for="">Turno</label>
            <select class="form-control" name="turno_id" required v-model="draft.turno_id">
                <option value="">Seleccione...</option>
                <option value="1">MATUTINO</option>
                <option value="2">VESPERTINO</option>
                <option value="3">NOCTURNO</option>
                <option value="4">DISCONTINUO</option>
                <option value="5">CONTINUO</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Año de egreso</label>
            <select class="form-control" name="fecha_egreso" required v-model="draft.fecha_egreso">
                <option value="">Seleccione...</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
            </select>
        </div>
        <div class="form-group">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" name="primera_vez" type="checkbox" v-model="draft.primera_vez">
                    Primera vez en el proceso
                </label>
            </div>
        </div>
        <div class="form-group mb-0">
            <button class="btn btn-success">Guardar</button>
        </div>
    </form>
</template>

<script>
    export default {
        name: "FormComponent",
        props: ['informacion', 'aspiranteid'],
        data() {
            return {
                draft: clone(this.informacion)
            }
        },
        methods: {
            save() {
                //this.$emit('save', this.draft);
                axios.post(route('aspirante.informacion.store', this.aspiranteid), {
                    clave_centro_trabajo: this.draft.clave_centro_trabajo,
                    nombre_centro_trabajo: this.draft.nombre_centro_trabajo,
                    turno_id: this.draft.turno_id,
                    fecha_egreso: this.draft.fecha_egreso,
                    primera_vez: this.draft.primera_vez,
                })
                    .then(res => {
                        console.log(res);
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            }
        }
    }
</script>

<style scoped>

</style>
