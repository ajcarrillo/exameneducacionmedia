<template>
    <div class="">
        <section class="p-0 bg-light" id="intro">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col col-md-10 col-lg-8">
                        <div class="row align-items-center">
                            <div class="col-4 col-lg-3">x</div>
                            <div class="col">x</div>
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
        </section>
    </div>
</template>

<script>
    import DatosGeneralesForm from './DatosGeneralesComponent';

    export default {
        name: "App",
        components: {
            DatosGeneralesForm
        },
        props: ['aspirante', 'paises', 'municipios', 'entidades'],
        computed: {
            isExterno() {
                return this.aspirante.is_aspirante_externo;
            },
            isQroo(){
                return this.aspirante.entidad_nacimiento_id === '23';
            },
            hasPaisNacimiento(){
                return this.aspirante.pais_nacimiento_id !== null;
            }
        }
    }
</script>

<style scoped>

</style>
