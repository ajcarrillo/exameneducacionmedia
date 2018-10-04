<template>
    <v-app>
        <v-navigation-drawer app v-model="drawer" :mini-variant.sync="mini" class="blue-grey darken-4" dark>
            <v-list class="pt-0" dense>
                <v-divider></v-divider>

                <v-list-tile v-for="item in items" :key="item.title" @click="">
                    <v-list-tile-action>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-tile-action>

                    <v-list-tile-content>
                        <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar app>
            <v-toolbar-side-icon @click.stop="mini = !mini"></v-toolbar-side-icon>
            <v-toolbar-title>{{ title }}</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items class="hidden-sm-and-down">
                <v-btn flat>Link One</v-btn>
                <v-btn flat>Link Two</v-btn>
                <v-btn flat>Link Three</v-btn>
            </v-toolbar-items>
        </v-toolbar>
        <v-content>
            <slot></slot>
        </v-content>
        <v-footer app></v-footer>
    </v-app>
</template>

<script>
    export default {
        props: ['title', 'items', 'user'],
        data() {
            return {
                drawer: true,
                mini: false,
            }
        },
    }
</script>

<style scoped>

</style>
