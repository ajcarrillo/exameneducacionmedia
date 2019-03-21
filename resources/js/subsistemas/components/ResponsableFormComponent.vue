<template>
    <form @submit.prevent="submit">
        <vue-form-generator :model="model" :options="formOptions" :schema="schema"></vue-form-generator>
        <div class="form-group mb-0">
            <button class="btn btn-primary" :disabled="isSaving">
                <template v-if="!isSaving">
                    Guardar
                </template>
                <template v-else>
                    Guardando...
                </template>
            </button>
            <router-link :to="{name:'subsistemas.home'}">
                <a class="btn btn-default">Regresar</a>
            </router-link>
        </div>
    </form>
</template>

<script>
    import store from '../store/store';
    import VueFormGenerator from "vue-form-generator";

    export default {
        name: "ResponsableFormComponent",
        components: {
            "vue-form-generator": VueFormGenerator.component
        },
        props: ['plantelid'],
        data() {
            return {
                isSaving: false,
                model: {
                    nombre: '',
                    primer_apellido: '',
                    segundo_apellido: '',
                    email: '',
                    password: '',
                    username: ''
                },
                schema: {
                    fields: [
                        {
                            type: 'input',
                            inputType: 'text',
                            model: 'nombre',
                            label: 'Nombre(s)',
                            required: true,
                        },
                        {
                            type: 'input',
                            inputType: 'text',
                            model: 'primer_apellido',
                            label: 'Primer apellido',
                            required: true,
                        },
                        {
                            type: 'input',
                            inputType: 'text',
                            model: 'segundo_apellido',
                            label: 'Segundo apellido',
                            required: false,
                        },
                        {
                            type: 'input',
                            inputType: 'email',
                            model: 'email',
                            label: 'E-mail',
                            required: true,
                        },
                        {
                            type: 'input',
                            inputType: 'password',
                            model: 'password',
                            label: 'Contraseña',
                            required: true
                        },
                    ],
                },
                formOptions: {
                    validateAfterLoad: true,
                    validateAfterChanged: true,
                    validateAsync: true
                }
            }
        },
        methods: {
            submit() {
                this.isSaving = true;
                store.dispatch('home/asignarResponsable', {
                    responsable: this.model,
                    uuid: this.plantelid
                })
                    .then(res => {
                        this.resetForm();
                        this.$notify({
                            group: 'notify',
                            title: 'Notificaciones',
                            text: 'El responsable del plantel se asignó correctamente',
                            type: 'success'
                        });
                        this.$router.push({name: 'subsistemas.home'});
                    })
                    .catch(err => {
                        this.savingFinished();
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Lo sentimos, algo ha salido mal intenta de nuevo',
                        });
                        console.log(err.response);
                    })
            },
            resetForm() {
                this.savingFinished();
                this.model.nombre = '';
                this.model.primer_apellido = '';
                this.model.segundo_apellido = '';
                this.model.email = '';
                this.model.password = '';
                this.model.username = '';
            },
            savingFinished(){
                this.isSaving = false;
            }
        }
    }
</script>

<style scoped>

</style>
