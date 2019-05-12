<template>
    <v-container fluid fill-height>
                <v-layout  align-center justify-center>
                    <v-flex xs12 sm8 md4>
                        <v-card class="elevation-12">
                            <v-toolbar dark color="primary">
                                <v-toolbar-title dark>Login Form</v-toolbar-title>
                            </v-toolbar>
                            <v-card-text>
                                <v-form  >
                                    <v-text-field v-model="user.email" prepend-icon="email" name="email" label="Email" type="email"></v-text-field>
                                    <v-text-field v-model="user.password"  id="password" prepend-icon="lock" name="password" label="Password" type="password"></v-text-field>
                                </v-form>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="primary" @click="Login">Login</v-btn>
                            </v-card-actions>
                        </v-card>
                        <v-snackbar v-model="snackbar" :timeout="timeout">
                            {{ text }}
                            <v-btn color="red" flat @click="snackbar = false">
                                Close
                            </v-btn>
                        </v-snackbar>
                    </v-flex>
                </v-layout>
            </v-container>
</template>
<script>
    import axios from 'axios'
    export default {
        name: "Login",
        data: () => ({
            drawer: null,
            snackbar : false,
            timeout: 6000,
            text: '',
            user:{
                email: '',
                password : ''
            }
        }),
        methods:{
            Login(){
                axios.post('/api/login',this.user).then(res=>{
                    if(res.data.api_token != null){
                        localStorage.setItem('api_token',res.data.api_token)
                        localStorage.setItem('log_in','true')
                        this.$router.push('list')

                    }
                    else{
                        if(res.data.error == true){
                            this.snackbar = true
                            this.text = " Login Failed"
                        }
                    }
                }).catch(res=>{
                    console.log(res.data)
                })
            }
        },
        created(){
            console.log(localStorage.getItem('api_token'))
        },
        props: {
            source: String
        }
    }
</script>

<style scoped>

</style>
