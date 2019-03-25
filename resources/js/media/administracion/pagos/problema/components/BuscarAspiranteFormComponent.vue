<template>
    <form @submit.prevent="buscarAspirante">
        <div class="form-group text-right">
            <a @click="$modal.hide('hello-world')">Terminar</a>
        </div>
        <div class="form-group">
            <input class="form-control"
                   placeholder="Nombre completo o email"
                   type="text"
                   v-model="search">
        </div>
        <div class="form-group">
            <input class="form-control"
                   placeholder="Matrícula, folio o curp"
                   type="text"
                   v-model="curp">
            <small class="text-muted" v-if="searching">Buscando...</small>
        </div>
        <button class="hide">Buscar</button>
    </form>
</template>

<script>
    import store from '../../store/store';

    export default {
        props: ['solicitud', 'pago'],
        data() {
            return {
                search: '',
                curp: '',
                searching: false
            }
        },
        methods: {
            buscarAspirante() {
                let search = this.search;
                let curp = this.curp;
                this.searching = true;
                store.dispatch('buscarAspirnantes', {search, curp})
                    .then(res => {
                        this.searching = false;
                    })
                    .catch(err => {
                        this.searching = false;
                    })
            }
        }
    }
</script>

<style scoped>
    a:not([href]):not([tabindex]) {
        color: #007bff;
        text-decoration: none;
        background-color: transparent;
        -webkit-text-decoration-skip: objects;
        cursor: pointer;
    }
</style>
