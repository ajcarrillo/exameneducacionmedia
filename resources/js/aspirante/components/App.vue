<template>
    <div class="">
        <section class="p-0 bg-light" id="intro">
            <div class="container">
                <div class="row justify-content-center py-3">
                    <div class="col col-md-10 col-lg-8">
                        <a href="/aspirantes" style="font-size: 2rem">
                            <i class="far fa-arrow-alt-circle-left"></i>
                        </a>
                    </div>
                </div>
                <div class="row justify-content-center pb-5">
                    <div class="col col-md-10 col-lg-8">
                        <div class="row align-items-center">
                            <div class="col-4 col-lg-3">
                                <avatar :gender="aspirante.sexo"></avatar>
                            </div>
                            <div class="col">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h2 class="mb-0"><b>{{ nombreCompleto }}</b></h2>
                                        <span class="text-muted">Folio: {{ aspirante.folio }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="p-0 bg-light" id="forms">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8">
                        <datos-generales-form
                            :aspirante="aspirante"
                            :entidades="entidades"
                            :externo="isExterno"
                            :municipios="municipios"
                            :paises="paises"
                        >
                        </datos-generales-form>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8">
                        <create-informacion-procedencia
                            v-if="!hasInformacionProcedencia"
                            @update="updateInfoProcedencia"
                            :aspiranteid="aspirante.id"
                        ></create-informacion-procedencia>
                        <edit-informacion-procedencia
                            :aspiranteid="aspirante.id"
                            :informacion="aspirante.informacion_procedencia"
                            v-else
                        ></edit-informacion-procedencia>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8">
                        <div class="card shadow-none border">
                            <div class="card-body">
                                <create-domicilio :aspiranteid="aspirante.id"
                                                  :municipios="municipios"
                                                  @update="updateDomicilio"
                                                  v-if="!hasDomicilio"
                                ></create-domicilio>
                                <edit-domicilio :aspiranteid="aspirante.id"
                                                :domicilio="aspirante.domicilio"
                                                :municipios="municipios"
                                                v-else
                                ></edit-domicilio>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import DatosGeneralesForm from './DatosGeneralesComponent';
    import CreateInformacionProcedencia from './informacion_procedencia/CreateComponent';
    import EditInformacionProcedencia from './informacion_procedencia/EditComponent';
    import CreateDomicilio from './domicilio/CreateComponent';
    import EditDomicilio from './domicilio/EditComponent';
    import Avatar from '../../components/UserAvatarComponent';

    export default {
        name: "App",
        components: {
            DatosGeneralesForm,
            CreateInformacionProcedencia,
            EditInformacionProcedencia,
            CreateDomicilio,
            EditDomicilio,
            Avatar
        },
        props: ['asp', 'paises', 'municipios', 'entidades'],
        data() {
            return {
                aspirante: this.asp,
            }
        },
        computed: {
            isExterno() {
                return this.aspirante.is_aspirante_externo;
            },
            isQroo() {
                return this.aspirante.entidad_nacimiento_id === '23';
            },
            hasPaisNacimiento() {
                return this.aspirante.pais_nacimiento_id !== null;
            },
            hasInformacionProcedencia() {
                return this.aspirante.informacion_procedencia_id !== null;
            },
            hasDomicilio() {
                return this.aspirante.domicilio_id !== null;
            },
            usuario() {
                return this.aspirante.user;
            },
            nombreCompleto() {
                return `${this.usuario.nombre} ${this.usuario.primer_apellido} ${this.usuario.segundo_apellido === null ? '' : this.usuario.segundo_apellido}`;
            }
        },
        methods: {
            updateInfoProcedencia(informacion) {
                this.aspirante.informacion_procedencia_id = informacion.id;
                this.aspirante.informacion_procedencia = informacion;
            },
            updateDomicilio(domicilio) {
                this.aspirante.domicilio_id = domicilio.id;
                this.aspirante.domicilio = domicilio;
            }
        }
    }
</script>

<style scoped>

</style>
