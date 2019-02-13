<template>
    <form @submit.prevent="submit">
        <template v-if="!editMode">
            <button @click="update()" class="btn btn-link" type="button">
                <i class="fa fa-pen"></i>&nbsp;
                {{ plantelname }}
            </button>
        </template>
        <template v-else>
            <input autofocus class="form-control" type="text" v-model="draft">
            <small class="form-text text-muted">
                Presione enter para guardar.
                <span
                    @click="editMode = !editMode"
                    class="text-danger"
                    style="cursor: pointer"
                >
                    Cerrar
                </span>
            </small>
        </template>
    </form>
</template>

<script>
    import store from '../store/store';

    export default {
        name: "EditPlantelNameFormComponent",
        props: ['plantelname', 'plantelid'],
        data() {
            return {
                editMode: false,
                draft: ''
            }
        },
        created() {
            let draft = this.plantelname.split("/");
            this.draft = draft.length > 1 ? draft[1].trim() : draft[0].trim();
        },
        methods: {
            update: function () {
                if (!this.isValidForChange('*')) {
                    return 0;
                }

                this.editMode = !this.editMode
            },
            submit() {
                axios.patch(route('api.plantel.actulizar.nombre', this.plantelid), {
                    nombre: this.draft
                })
                    .then(res => {
                        if (res.data.meta.code == 200) {
                            this.$emit('submit', {draft: res.data.nombre, id: this.plantelid})
                        }
                    })
                    .catch(err => {
                        console.log(err.response)
                    });
            },
            getState(tipo = 'aforo') {
                let state = store.state.home;
                return tipo === 'oferta' ? state.estadoOferta : state.estado;
            },
            isValidForChange(type = '*') {
                if (type === "*" || type === "aforo") {
                    if (this.getState("aforo") === "R") {
                        this.sweet("El aforo esta en revisión");
                        return 0;
                    }

                    if (this.getState("aforo") === "A") {
                        this.sweet("El aforo ha sido aceptado");
                        return 0;
                    }
                }

                if (type === "*" || type === "oferta") {
                    if (this.getState("oferta") === "R") {
                        this.sweet("La oferta esta en revisión");
                        return 0;
                    }

                    if (this.getState("oferta") === "A") {
                        this.sweet("La oferta ha sido aceptada");
                        return 0;
                    }
                }

                return true;
            },
            sweet(text = "", title = "", type = "info") {
                swal.fire({
                    type: type,
                    title: title,
                    text: text,
                    footer: ''
                })
            }
        },
    }
</script>

<style scoped>

</style>
