<template>
    <li class="p-3">
        <div class="row">
            <div class="col">
                <div class="d-sm-flex flex-sm-row align-items-center">
                    <div class="pr-3 d-inline-flex"><button class="btn btn-info btn-sm">{{ oferta.active ? 'Desactivar':'Activar'}}</button></div>
                    <div class="pr-3 d-inline-flex"><button class="btn btn-primary btn-sm">Agregar grupo</button></div>
                    <div class="pr-3 d-inline-flex"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></div>
                    <div class="pr-3 pt-3 pt-sm-0">
                        <span style="font-size: 18px; font-weight: bold;">{{ oferta.especialidad.referencia}}</span>
                    </div>
                </div>
                <div class="d-flex flex-row pt-3">
                    <p>{{ oferta.especialidad.descripcion }}</p>
                </div>
                <div class="d-flex flex-row pt-3">
                    <p><strong>Programa de estudios: </strong>{{ oferta.programa_estudio.descripcion}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="d-flex flex-row align-items-center">
                    <div class="pr-3">
                        <label for="">Grupos:</label>
                        <span>{{ grupos }}</span></div>
                    <div class="pr-3">
                        <label for="">Alumnos por grupo:</label>
                        <span>{{ alumnosPorGrupo }}</span></div>
                    <div class="pr-3">
                        <label for="">Total:</label>
                        <span>{{ total }}</span></div>
                </div>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        name: "OfertaCardComponent",
        components: {},
        props: ['oferta'],
        data() {
            return {
                expanded: false
            }
        },
        computed:{
            hasGrupos(){
                return this.oferta.grupos !== null;
            },
            total(){
                return this.alumnosPorGrupo * this.grupos;
            },
            grupos(){
                return this.hasGrupos ? this.oferta.grupos.grupos : 0
            },
            alumnosPorGrupo(){
                return this.hasGrupos ? this.oferta.grupos.alumnos : 0;
            },

        }
    }
</script>

<style scoped>

</style>
