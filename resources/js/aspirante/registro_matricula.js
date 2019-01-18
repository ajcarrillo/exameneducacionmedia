require('../bootstrap');
window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    data: {
        matricula: '',
        form: {
            email: '',
            password: null,
            nombre: '',
            primer_apellido: '',
            segundo_apellido: ''
        },
        estudiante: {},
        isSearching: false
    },
    computed: {
        persona() {
            return _.isEmpty(this.estudiante) ? {} : this.estudiante.estudiante.persona;
        },
        centroTrabajo() {
            return _.isEmpty(this.estudiante) ? {} : `${this.estudiante.centro_trabajo.clave} ${this.estudiante.centro_trabajo.nombre}`
        },
        isEstudianteEmpty() {
            return _.isEmpty(this.estudiante);
        }
    },
    methods: {
        resetForm() {
            this.email = '';
            this.password = null;
            this.nombre = '';
            this.primer_apellido = '';
            this.segundo_apellido = '';
            this.estudiante = {};
        },
        buscarMatricula() {
            this.isSearching = true;
            this.resetForm();

            axios.post(route('buscar.matricula'), {
                matricula: this.matricula
            })
                .then(res => {
                    this.estudiante = res.data.alumno.estudiante;
                    this.form.nombre = this.persona.nombre;
                    this.form.primer_apellido = this.persona.primer_apellido;
                    this.form.segundo_apellido = this.persona.segundo_apellido;
                    this.isSearching = false;
                })
                .catch(err => {
                    this.isSearching = false;
                    console.log(err.response);
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Lo sentimos, algo ha salido mal intenta de nuevo',
                    })
                });
        },
        register() {
            axios.post(route('registro.matricula'), {
                nombre: this.form.nombre,
                primer_apellido: this.form.primer_apellido,
                segundo_apellido: this.form.segundo_apellido,
                email: this.form.email,
                password: this.form.password,
                alumno_id: this.estudiante.id,
                sexo: this.persona.sexo,
                pais_nacimiento_id: this.persona.pais_nacimiento,
                entidad_nacimiento_id: this.persona.entidad_nacimiento,

            })
                .then(res => {
                    window.location.replace("/aspirantes");
                })
                .catch(err => {
                    console.log(err.response);
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Lo sentimos, algo ha salido mal intenta de nuevo',
                    })
                });
        }
    }
});
