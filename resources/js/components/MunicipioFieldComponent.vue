<template>
    <select name="cve_mun" class="form-control" :value="value" @input="updateValue($event.target.value)">
        <option value="">Seleccione</option>
        <option v-for="municipio in municipios" :value="municipio.value" :key="municipio.value">{{ municipio.label }}</option>
    </select>
</template>

<script>
    export default {
        props: ['cveEnt'],
        data() {
            return {
                value: '',
                municipios: []
            }
        },
        computed: {
            entidad_id() {
                return this.cveEnt;
            }
        },
        created() {
            axios.get(route('api.municipios.index', {cve_ent: this.entidad_id}))
                .then(res => {
                    this.municipios = res.data.municipios
                })
                .catch(err => {
                    console.log(err.response)
                })
        },
        methods: {
            updateValue(val){
                this.$emit('input', val)
            }
        }
    }
</script>

<style scoped>

</style>
