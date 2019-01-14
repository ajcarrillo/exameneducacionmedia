<template>
    <form @submit.prevent="save">
        <div class="form-group">
            <label for="">Especialidad</label>
            <select class="form-control"
                    name=""
                    required
                    v-model="draft.especialidad_id"
            >
                <option value="">Seleccione...</option>
                <option :value="especialidad.id"
                        v-for="especialidad in especialidades"
                >
                    {{ especialidad.referencia }}
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Programa de estudios</label>
            <select class="form-control"
                    name=""
                    required
                    v-model="draft.programa_estudio_id"
            >
                <option value="">Seleccione...</option>
                <option :value="programa.id"
                        v-for="programa in programas"
                >
                    {{ programa.descripcion }}
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Clave</label>
            <input class="form-control"
                   required
                   type="text"
                   v-model="draft.clave"
            >
        </div>
        <div class="form-group mb-0">
            <button class="btn btn-success">Guardar</button>
        </div>
    </form>
</template>

<script>
    export default {
        name: "OfertaForm",
        props: ['oferta', 'especialidades', 'programas'],
        data() {
            return {
                draft: clone(this.oferta)
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
