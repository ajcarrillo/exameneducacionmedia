<template>
    <form @submit.prevent="buscarAspirante">
        <div class="form-group text-right">
            <a @click="$modal.hide('hello-world')">Terminar</a>
        </div>
        <div class="form-group">
            <input autofocus
                   class="form-control"
                   placeholder="Matrícula, folio, nombre completo, email, curp"
                   required
                   type="text"
                   v-model="search">
            <small class="text-muted" v-if="searching">Buscando...</small>
        </div>
    </form>
</template>

<script>
    import store from '../../store/store';

    export default {
        props: ['solicitud', 'pago'],
        data() {
            return {
                search: '',
                searching: false
            }
        },
        methods: {
            buscarAspirante() {
                let search = this.search;
                this.searching = true;
                store.dispatch('buscarAspirnantes', {search})
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
