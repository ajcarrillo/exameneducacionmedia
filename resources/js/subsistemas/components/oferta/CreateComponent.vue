<template>
    <modal :name="'create-oferta'"
           :pivotY="1"
           classes="v--modal rounded-0"
           height="auto"
           width="100%"
           transition="overlay-fade"
    >
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 py-5">
                    <oferta-form
                        :especialidades="especialidades"
                        :oferta="oferta"
                        :programas="programas"
                    ></oferta-form>
                </div>
            </div>
        </div>
    </modal>
</template>

<script>
    import store from '../../store/store';
    import OfertaForm from './OfertaForm'

    export default {
        name: "CreateComponent",
        components: {
            OfertaForm
        },
        props: ['plantelid'],
        data() {
            return {
                programas: [],
                oferta: {
                    plantel_id: this.plantelid,
                    especialidad_id: '',
                    active: '1',
                    clave: '',
                    programa_estudio_id: '',
                }
            }
        },
        created() {
            store.dispatch('especialidad/getEspecialidades')
                .catch(err => {
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Lo sentimos, algo ha salido mal intenta de nuevo',
                    })
                    console.log(err.response);
                });

            axios.get(route('api.programas'))
                .then(res => {
                    this.programas = res.data.programas;
                })
                .catch(err => {
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Lo sentimos, algo ha salido mal intenta de nuevo',
                    })
                    console.log(err.response);
                })
        },
        computed: {
            especialidades() {
                return store.state.especialidad.especialidades;
            }
        },
        methods: {
        }
    }
</script>

<style scoped>
    .overlay-fade-enter-active,
    .overlay-fade-leave-active {
        transition: all 0.2s;
    }

    .overlay-fade-enter,
    .overlay-fade-leave-active {
        opacity: 0;
    }

    .nice-modal-fade-enter-active,
    .nice-modal-fade-leave-active {
        transition: all 0.4s;
    }

    .nice-modal-fade-enter,
    .nice-modal-fade-leave-active {
        opacity: 0;
        transform: translateY(-20px);
    }
</style>
