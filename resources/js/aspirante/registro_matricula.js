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
        centroTrabajo() {
            return _.isEmpty(this.estudiante) ? {} : `${this.estudiante.clave_centro_trabajo} ${this.estudiante.nombre_centro_trabajo}`
        },
        nombreCompleto() {
            return _.isEmpty(this.estudiante) ? '' : `${this.estudiante.nombre} ${this.estudiante.primer_apellido} ${this.estudiante.segundo_apellido}`;
        },
        isEstudianteEmpty() {
            return _.isEmpty(this.estudiante);
        },
        hasFechaNacimiento() {
            return this.estudiante.fecha_nacimiento !== '0000-00-00';
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
                    console.log(res.data);
                    /*
                        alumno_id: 126887
                        clave_centro_trabajo: "23PES0066O"
                        curp: "ROHM030304HDFDRGA9"
                        fecha_nacimiento: "2004-01-01"
                        matricula: "2003117644"
                        nombre: "MIGUEL ANGEL"
                        nombre_centro_trabajo: "JEAN PIAGET"
                        primer_apellido: "RODRIGUEZ"
                        segundo_apellido: "HERNANDEZ"
                        turno_id: 1
                    * */
                    this.estudiante = res.data;
                    this.form.nombre = this.estudiante.nombre;
                    this.form.primer_apellido = this.estudiante.primer_apellido;
                    this.form.segundo_apellido = this.estudiante.segundo_apellido;
                    this.form.fecha_nacimiento = this.estudiante.fecha_nacimiento;
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
                curp: this.estudiante.curp,
                nombre: this.form.nombre,
                password: this.form.password,
                alumno_id: this.estudiante.alumno_id,
                primer_apellido: this.form.primer_apellido,
                segundo_apellido: this.form.segundo_apellido,
                fecha_nacimiento: this.form.fecha_nacimiento,
                clave_centro_trabajo: this.estudiante.clave_centro_trabajo,
                nombre_centro_trabajo: this.estudiante.nombre_centro_trabajo,
                matricula: this.estudiante.matricula,
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
