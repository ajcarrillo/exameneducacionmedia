<template>
    <span class="invalid-feedback" role="alert">
        <slot></slot>
    </span>
</template>

<script>
    export default {
        name: "FormErrors",
        props: ['errors']
    }
</script>

<style scoped>

</style>
