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
                if (this.getState()==='R' || this.getState()==='A') {
                    this.mensaje(this.getState());
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
            getState() {
                return store.state.home.estado;
            },
            mensaje(tipo) {
                let mensaje="";

                switch (tipo) {
                    case 'R':
                        mensaje = "El aforo esta en revisión";
                        break;
                    case 'A':
                        mensaje = "El aforo ha sido aceptado";
                        break;
                    default:
                        mensaje= " ";

                }

                Swal.fire({
                    type: 'info',
                    title: '',
                    text: mensaje,
                    footer: ''
                })
            }
        },
    }
</script>

<style scoped>

</style>
