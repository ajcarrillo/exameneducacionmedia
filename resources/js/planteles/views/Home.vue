<template>
    <v-container fluid>
        <v-layout row>
            <v-flex md12>
                <h1>Plantel</h1>
                <h2>{{ message }}</h2>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        data(){
            return {
                message:'plantel'
            }
        }
    }
</script>

<style scoped>

</style>
