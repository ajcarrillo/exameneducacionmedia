<template>
    <form @submit.prevent="save">
        <div class="form-group">
            <label for="">Especialidad</label>
            <input type="text"
                   class="form-control"
                   name="referencia"
                   v-model="draft.referencia"
            >
        </div>
        <div class="form-group">
            <label for="">Descripción</label>
            <textarea class="form-control"
                      name="descripcion"
                      cols="30" rows="10"
                      v-model="draft.descripcion"
            ></textarea>
        </div>
        <div class="form-group mb-0">
            <button class="btn btn-primary">Guardar</button>
        </div>
    </form>
</template>

<script>
    export default {
        name: "EspecialidadForm",
        props: ['especialidad'],
        data() {
            return {
                draft: clone(this.especialidad),
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
