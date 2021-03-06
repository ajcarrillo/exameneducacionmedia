<template>
    <div class="card shadow-none border">
        <div class="card-body">
            <form @submit.prevent="save">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input :disabled="!externo" class="form-control" name="nombre" required type="text" v-model="datos.nombre">
                </div>
                <div class="form-group">
                    <label for="primer_apellido">Primer apellido</label>
                    <input :disabled="!externo" class="form-control" name="primer_apellido" required type="text" v-model="datos.primer_apellido">
                </div>
                <div class="form-group">
                    <label for="segundo_apellido">Segundo apellido</label>
                    <input :disabled="!externo" class="form-control" name="segundo_apellido" type="text" v-model="datos.segundo_apellido">
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="fecha_nacimiento">Fecha nacimiento</label>
                        <input :disabled="!externo" class="form-control" name="fecha_nacimiento" required type="date" v-model="datos.fecha_nacimiento">
                    </div>
                    <div class="col d-flex align-items-center">
                        <label class="mr-3" for="">Sexo:</label>
                        <label class="checkbox-inline pr-3">
                            <input name="sexo" required type="radio" v-model="datos.sexo" value="H">
                            H
                        </label>
                        <label class="checkbox-inline">
                            <input name="sexo" required type="radio" v-model="datos.sexo" value="M">
                            M
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pais_nacimiento_id">Pais nacimiento</label>
                    <select class="form-control" name="pais_nacimiento_id" required v-model="datos.pais_nacimiento_id">
                        <option value="">Seleccione...</option>
                        <option :key="pais.id" :value="pais.id" v-for="pais in paisesFiltered">{{ pais.descripcion }}</option>
                    </select>
                </div>
                <div class="form-group" v-if="isMexa">
                    <label for="entidad_nacimiento_id">Entidad de nacimiento</label>
                    <select class="form-control" name="entidad_nacimiento_id" required v-model="datos.entidad_nacimiento_id">
                        <option value="">Seleccione...</option>
                        <option :key="entidad.id" :value="entidad.id" v-for="entidad in entidades">{{ entidad.descripcion }}</option>
                    </select>
                </div>
                <div class="form-group" v-if="isMexa">
                    <label for="curp">CURP</label>
                    <input :disabled="aspirante.curp !== null" class="form-control" name="curp" required type="text" v-model="datos.curp">
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input class="form-control" name="telefono" required type="text" v-model="datos.telefono">
                    <small class="text-muted">Proporciona tu teléfono para tener una mejor comunicación contigo.</small>
                </div>
                <div class="form-group mb-0">
                    <button :disabled="saving" class="btn btn-success">
                        <template v-if="!saving">
                            <span>Guardar</span>
                        </template>
                        <template v-else>
                            <span>Guardando...</span>
                        </template>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "DatosGeneralesComponent",
        props: ['aspirante', 'paises', 'municipios', 'entidades', 'externo'],
        data() {
            return {
                datos: {
                    nombre: this.aspirante.user.nombre,
                    primer_apellido: this.aspirante.user.primer_apellido,
                    segundo_apellido: this.aspirante.user.segundo_apellido,
                    telefono: this.aspirante.telefono,
                    sexo: this.aspirante.sexo,
                    pais_nacimiento_id: this.aspirante.pais_nacimiento_id,
                    entidad_nacimiento_id: this.aspirante.entidad_nacimiento_id,
                    fecha_nacimiento: this.aspirante.fecha_nacimiento,
                    curp: this.aspirante.curp,
                    curp_historica: '',
                    curp_valida: '',
                },
                saving: false,
                errors: [],
                fields: [
                    'nombre',
                    'primer_apellido',
                    'telefono',
                    'sexo',
                    'pais_nacimiento_id',
                    'entidad_nacimiento_id',
                    'fecha_nacimiento',
                    'curp',
                ]
            }
        },
        created() {

        },
        computed: {
            paisNacimiento() {
                let that = this;

                let filter = _.filter(this.entidades, function (el) {
                    return el.id === that.aspirante.entidad_nacimiento_id;
                });

                return filter.length ? 'MX' : 'null';
            },
            isMexa() {
                return this.datos.pais_nacimiento_id === 'MX';
            },
            paisesFiltered() {
                if (this.paisNacimiento === 'MX') {
                    return _.filter(this.paises, function (el) {
                        return el.id === 'MX';
                    })
                }

                return this.paises;
            }
        },
        methods: {
            save() {
                this.errors = [];
                this.saving = true;
                axios.patch(route('aspirante.update', this.aspirante.id), {
                    nombre: this.datos.nombre,
                    primer_apellido: this.datos.primer_apellido,
                    segundo_apellido: this.datos.segundo_apellido,
                    telefono: this.datos.telefono,
                    sexo: this.datos.sexo,
                    pais_nacimiento_id: this.datos.pais_nacimiento_id,
                    entidad_nacimiento_id: this.datos.entidad_nacimiento_id,
                    fecha_nacimiento: this.datos.fecha_nacimiento,
                    curp: this.datos.curp,
                    curp_historica: false,
                    curp_valida: false,
                })
                    .then(res => {
                        this.savingDone();
                        this.aspirante.curp_historica = res.data.curp_historica;
                        this.aspirante.curp_valida = res.data.curp_valida;
                        this.aspirante.pais_nacimiento_id = res.data.pais_nacimiento_id;
                        swal({
                            type: 'success',
                            text: 'Los datos generales se guardaron correctamente',
                        })
                    })
                    .catch(err => {
                        this.savingDone();
                        let msg = '<p>Verifica que tus datos estén correctos</p>';
                        this.errors = err.response.data.errors;
                        for (let field in this.errors) {
                            msg+='<ul class="list-unstyled">';
                            msg += `<li>${this.errors[field]}</li>`;
                            msg+='</ul>';
                        }
                        swal({
                            type: 'warning',
                            title: '¡Atención!',
                            html: msg,
                        });
                        console.log(err.response)
                    })
            },
            savingDone() {
                this.saving = false;
            }
        },
    }
</script>

<style scoped>

</style>
