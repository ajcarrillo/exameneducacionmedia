<template>
    <div class="plantel-row">
        <button class="btn btn-link btn-block card-btn p-3">
            <span class="row">
                <span class="col-12 col-md-6">{{ nombreCompleto }}</span>
                <span class="col-12 col-md-2">{{ subsistema }}</span>
                <span class="col-12 col-md-4">{{ munLoc }}</span>
            </span>
        </button>
    </div>
</template>

<script>
    export default {
        name: "RowItem",
        props: ['plantel'],
        computed: {
            nombreCompleto() {
                return `${this.plantel.clave} ${this.plantel.nombre}`
            },
            munLoc() {
                return `${this.plantel.inmueble.municipio.NOM_MUN}/${this.plantel.inmueble.localidad.NOM_LOC}`;
            },
            subsistema() {
                return this.plantel.subsistema == undefined ? 'SIN SUBSISTEMA' : this.plantel.subsistema.referencia;
            }
        }
    }
</script>

<style scoped>
    .card-btn {
        color: #1e2022;
        text-align: left;
        white-space: inherit;
        font-size: 0.9375rem;
    }

    .card-btn:not(:disabled):not(.disabled).active, .card-btn:not(:disabled):not(.disabled):active {
        -webkit-box-shadow: 0 0 0 0 transparent;
        box-shadow: 0 0 0 0 transparent;
    }

    .card-btn:hover {
        color: #0052ea;
        text-decoration: none;
        background-color: transparent;
        border-color: transparent;
    }

    .plantel-row:hover {
        background-color: #f8fafd;
    }
</style>
