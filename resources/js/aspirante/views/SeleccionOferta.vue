<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col">

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "app",
        components: {},
        props: ['mun', 'opciones'],
        computed: {
            municipios() {
                return this.mun;
            },
            opcionesEducativas() {
                return this.opciones;
            }
        }
    }
</script>

<style scoped>

</style>
