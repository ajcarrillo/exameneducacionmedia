<template>
    <div class="">
        <router-view></router-view>
        <notifications group="notify" />
    </div>
</template>

<script>
    export default {
        props: ['subsistemaId']
    }
</script>

<style scoped>

</style>
