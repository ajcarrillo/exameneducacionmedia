<template>
    <table class="table">
        <thead>
            <tr>
                <th v-for="{text, value, align, width, index} in headers" :key="index" :class="'text-'+align" :width="width">{{ text }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item, index) in items" :key="index">
                <slot name="items" :item="item" :index="index">
                    <td v-for="{text, value, index} in headers" :key="index">
                        {{ item[value] }}
                    </td>
                </slot>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props: ['items', 'headers']
    }
</script>

<style scoped>

</style>
