<script>
    import Form from './FormComponent';

    export default {
        props: ['aspiranteid', 'municipios'],
        data() {
            return {
                saving: false
            }
        },
        render(createElement) {
            return createElement(Form, {
                props: {
                    domicilio: {
                        cve_ent: 23,
                        cve_mun: '',
                        cve_loc: '',
                        colonia: '',
                        calle: '',
                        numero: '',
                        codigo_postal: '',
                    },
                    municipios: this.municipios,
                    saving: this.saving,
                },
                on: {
                    save: (draft) => {
                        this.saving = true;
                        axios.post(route('aspirante.domicilio.store', this.aspiranteid), draft)
                            .then(res => {
                                this.saving = false;
                                swal({
                                    type: 'success',
                                    text: 'El domicilio ha sido guardado correctamente',
                                });
                                this.$emit('update', res.data.domicilio);
                            })
                            .catch(err => {
                                this.saving = false;
                                console.log(err.response);
                                swal({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: 'Lo sentimos, algo ha salido mal intenta de nuevo',
                                })
                            })
                    }
                }
            })
        },
    }
</script>

<style scoped>

</style>
