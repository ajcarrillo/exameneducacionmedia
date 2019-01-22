require('../bootstrap');
window.Vue = require('vue');

import FormErrors from '../components/FormErrors';

const app = new Vue({
    el: '#app',
    components: {
        FormErrors
    },
    data: {
        matricula: '',
        form: {
            email: '',
            password: null,
            nombre: '',
            primer_apellido: '',
            segundo_apellido: '',
            fecha_nacimiento: ''
        },
        formErrors: [],
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
        },
        hasFechaNacimiento(){
            return this.persona.fecha_nacimiento !== '0000-00-00';
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
            this.formErrors = [];
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
                    this.form.fecha_nacimiento = this.persona.fecha_nacimiento;
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
                email: this.form.email,
                curp: this.persona.curp,
                sexo: this.persona.sexo,
                nombre: this.form.nombre,
                password: this.form.password,
                alumno_id: this.estudiante.id,
                primer_apellido: this.form.primer_apellido,
                segundo_apellido: this.form.segundo_apellido,
                fecha_nacimiento: this.form.fecha_nacimiento,
                pais_nacimiento_id: this.persona.pais_nacimiento,
                entidad_nacimiento_id: this.persona.entidad_nacimiento,
                clave_centro_trabajo: this.estudiante.centro_trabajo.clave,
                nombre_centro_trabajo: this.estudiante.centro_trabajo.nombre,
                turno_id: this.estudiante.turno_id
            })
                .then(res => {
                    window.location.replace("/aspirantes");
                })
                .catch(err => {
                    console.log(err.response.data);
                    let response = err.response;

                    if (response.status === 422) {
                        this.formErrors = response.data.errors;
                    } else {
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Lo sentimos, algo ha salido mal intenta de nuevo',
                        })
                    }
                });
        }
    }
});
