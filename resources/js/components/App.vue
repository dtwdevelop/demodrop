<template>
    <v-app id="inspire" dark>

        <v-navigation-drawer v-model="drawer" clipped fixed app>
            <v-list dense>
                <v-list-tile @click="">
                    <v-list-tile-action>
                        <v-icon>place</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title><router-link to="/">Near Coffee Drop</router-link></v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile @click="">
                    <v-list-tile-action>
                        <v-icon>add</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title><router-link to="/add">Add Coffe Drop</router-link></v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar app fixed clipped-left>
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>Coffe Drop  </v-toolbar-title>

                <v-toolbar-items class="hidden-sm-and-down">
                    <v-btn to="/">Near Coffee Drop</v-btn>
                    <v-btn to="/add">Add Coffe Drop</v-btn>
                </v-toolbar-items>

        </v-toolbar>
        <v-content>
            <v-container fluid fill-height>
                <v-layout justify-center align-center>
                    <v-flex>

                        <router-view></router-view>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
        <v-footer app fixed>
            <span>Coffe Drop &copy; 2019</span>
        </v-footer>
    </v-app>
</template>

<script>
    export default {
        name: "App",
        data: () => ({
            drawer: false
        }),
        props: {
            source: String
        }
    }
</script>

<style scoped>

</style>
