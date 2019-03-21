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
                <option value="2019">2019</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
                <option value="2014">2014</option>
                <option value="2013">2013</option>
                <option value="2012">2012</option>
                <option value="2011">2011</option>
                <option value="2010">2010</option>
                <option value="2009">2009</option>
                <option value="2008">2008</option>
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
            <button :disabled="saving" class="btn btn-success">
                <template v-if="!saving">
                    <span>Guardar</span>
                </template>
                <template v-else>
                    <span>Guardando...</span>
                </template>
            </button>
        </div>
    </form>
</template>

<script>
    export default {
        name: "FormComponent",
        props: ['informacion', 'aspiranteid', 'saving'],
        data() {
            return {
                draft: clone(this.informacion)
            }
        },
        methods: {
            save() {
                this.$emit('save', this.draft);
            }
        }
    }
</script>

<style scoped>

</style>
