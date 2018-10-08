<template>
    <v-select :options="localidades" v-model="selected" @input="updateValue(selected)"></v-select>
</template>

<script>
    import vSelect from 'vue-select'

    export default {
        props: ['entidad', 'municipio'],
        data() {
            return {
                localidades: [],
                selected: null,
            }
        },
        components: {vSelect},
        computed: {
            cveEnt() {
                return this.entidad
            },
            cveMun() {
                return this.municipio
            }
        },
        created() {
        },
        watch: {
            cveMun() {
                axios.get(route('api.localidad.index', {cve_ent: this.cveEnt, cve_mun: this.cveMun}))
                    .then(res => {
                        this.localidades = res.data.localidades;
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            }
        },
        methods: {
            updateValue(val){
                this.$emit('input', val.value)
            }
        }
    }
</script>

<style scoped>
</style>
