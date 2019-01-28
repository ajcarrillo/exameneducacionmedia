<script>
    import Form from './FormComponent';

    export default {
        name: "EditComponent",
        props: ['aspiranteid', 'domicilio', 'municipios'],
        data() {
            return {
                draft: clone(this.domicilio),
            }
        },
        render(createElement) {
            return createElement(Form, {
                props: {
                    domicilio: this.draft,
                    municipios: this.municipios
                },
                on: {
                    save: (draft) => {
                        let params = {'aspirante': this.aspiranteid, 'id': draft.id};
                        axios.patch(route('aspirante.domicilio.update', params), draft)
                            .then(res => {
                                swal({
                                    type: 'success',
                                    text: 'El domicilio ha sido actualizado correctamente',
                                })
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
