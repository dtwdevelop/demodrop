<template>
    <v-form >
        <v-container>
            <v-layout row justify-center>
                <v-flex xs12 sm6>
                    <v-text-field required  v-model="FormDrop.postcode"  label="Your postcode" value="Grocery delivery" hint="Postcode"></v-text-field>
                    <v-layout row wrap>
                    <v-flex xs12 sm6>
                        <v-text-field  v-model="FormDrop.opening_times.monday"  label="Open time Monday" value=""  hint="open"></v-text-field>
                        <v-text-field  v-model="FormDrop.closing_times.monday"  label="Close time Monday" value="" hint="close"></v-text-field>
                    </v-flex>

                    <v-flex xs12 sm6>
                        <v-text-field  v-model="FormDrop.opening_times.tuesday"  label="Open time Tuesday" value=""  hint="open"></v-text-field>
                        <v-text-field  v-model="FormDrop.closing_times.tuesday"  label="Close Tuesday" value="" hint="close"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field  v-model="FormDrop.opening_times.wednesday"  label="Open time Wednesday" value=""  hint="open"></v-text-field>
                        <v-text-field  v-model="FormDrop.closing_times.wednesday"  label="Close Wednesday" value="" hint="close"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field  v-model="FormDrop.opening_times.thursday"  label="Open time Thursday" value=""  hint="open"></v-text-field>
                        <v-text-field  v-model="FormDrop.closing_times.thursday"  label="Close time Thursday" value="" hint="close"></v-text-field>
                    </v-flex>


                    <v-flex xs12 sm6>
                        <v-text-field  v-model="FormDrop.opening_times.friday"  label="Open time Friday" value=""  hint="open"></v-text-field>
                        <v-text-field  v-model="FormDrop.closing_times.friday"  label="Close time Friday" value="" hint="close"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field  v-model="FormDrop.opening_times.saturday"  label="Open time Saturday" value=""  hint="open"></v-text-field>
                        <v-text-field  v-model="FormDrop.closing_times.saturday"  label="Close time Saturday" value="" hint="close"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field  v-model="FormDrop.opening_times.sunday"  label="Open time Sunday" value=""  hint="open"></v-text-field>
                        <v-text-field  v-model="FormDrop.closing_times.sunday"  label="Close Sunday" value="" hint="close"></v-text-field>
                    </v-flex>
                    </v-layout>
                    <v-btn color="info" @click="sendForm">Create</v-btn>
                    <div>
                    <v-snackbar v-model="snackbar" :timeout="timeout">
                        {{ text }}
                        <v-btn color="pink" flat @click="snackbar = false">
                            Close
                        </v-btn>
                    </v-snackbar>
                    </div>
                </v-flex>
            </v-layout>
        </v-container>
    </v-form>

</template>

<script>
    import axios from 'axios'
    export default {
        name: "Form",
        data(){
            return{
                snackbar : false,
                timeout: 6000,
                text: '',
                FormDrop :{
                    postcode: "",
                    opening_times: {
                        monday : "",
                        tuesday : "",
                        wednesday: "",
                        thursday: "",
                        friday : "",
                        saturday : "",
                        sunday: ""
                    },
                    closing_times: {
                        monday : "",
                        tuesday : "",
                        wednesday: "",
                        thursday: "",
                        friday : "",
                        saturday : "",
                        sunday: ""
                    }
                }
            }
        },
        methods:{
            sendForm(){
                axios.post('http://localhost:8000/location/',{
                    postcode: this.FormDrop.postcode,
                    opening_times : this.FormDrop.opening_times,
                    closing_times : this.FormDrop.closing_times

                }).then(res=>{
                    this.snackbar = true
                    this.text = "Created"
                    console.log(res)
                }).catch(res=>{
                    this.snackbar = true
                    this.text = "Server side error"
                    console.log(res)
                })
            }
        },
        beforeCreate() {
            if (localStorage.getItem('api_token') == null) {
                this.$router.push('cp')
            }
        }

    }
</script>

<style scoped>

</style>
