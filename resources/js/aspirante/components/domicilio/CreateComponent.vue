<script>
    import Form from './FormComponent';

    export default {
        props: ['aspiranteid', 'municipios'],
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
                    municipios: this.municipios
                },
                on: {
                    save: (draft) => {
                        axios.post(route('aspirante.domicilio.store', this.aspiranteid), draft)
                            .then(res => {
                                swal({
                                    type: 'success',
                                    text: 'El domicilio ha sido guardado correctamente',
                                });
                                this.$emit('update', res.data.domicilio);
                            })
                            .catch(err => {
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
