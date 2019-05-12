<template>
<v-layout>

    <v-flex xs12 sm8 offset-sm3 >
        <v-text-field required  v-model="nearPlace" @change="Search" @keypress="Search" label="Your postcode" value="" hint="Search near coffe drop"></v-text-field>
        <v-btn color="green" @click="Search">Search</v-btn>
        <v-list two-line subheader>
            <v-subheader inset>Near Places</v-subheader>
            <v-divider inset></v-divider>
            <v-subheader inset></v-subheader>
            <v-dialog v-model="dialog" width="600" >

                <v-layout>
                    <v-flex>
                        <v-card>
                            <v-card-title primary-title>
                                <div>
                                    <h3 class="headline mb-0">Recycle Cup</h3>
                                    <div>
                                        <v-form>
                                            <v-flex xs12 sm6>
                                               Service Center id: {{FormCups.loc_id}}
                                                <v-text-field  v-model="FormCups.Ristretto"  label="Ristretto" value=""  hint="brand"></v-text-field>
                                                <v-text-field  v-model="FormCups.Espresso"  label="Espresso" value="" hint="brand"></v-text-field>
                                                <v-text-field  v-model="FormCups.Lungo"  label="Lungo" value="" hint="brand"></v-text-field>

                                            </v-flex>
                                        </v-form>
                                    </div>
                                </div>
                            </v-card-title>

                            <v-card-actions>
                                <v-btn color="green" @click="sendFormCup">Send</v-btn>
                                <v-btn color="red"  @click="closeDialog">Close</v-btn>
<!--                                <template v-slot:activator="{ on }">-->
<!--                                    <v-btn color=" red" dark v-on="on">-->
<!--                                        Recycle-->
<!--                                    </v-btn>-->
<!--                                </template>-->
                            </v-card-actions>
                        </v-card>

                    </v-flex>
                </v-layout>
            </v-dialog>
            <v-list-tile v-for="item in dropLocation" :key="item.id" avatar @click="">
                <v-list-tile-content>
                    <v-list-tile-title>{{ item.postcode }}</v-list-tile-title>
                    <v-list-tile-sub-title>
                    </v-list-tile-sub-title>
                    <v-divider inset></v-divider>
                    Monday: {{ item.openMonday | checkOpen }}  {{ item.closeMonday }},
                    Tuesday: {{ item.openTuesday  }}  {{ item.closeTuesday }},
                    Wenesday: {{ item.openWensday }}  {{ item.closeWensday }},
                    Thursday: {{ item.openThursday }}  {{ item.closeThursday }},
                    Friday: {{ item.openFriday }}   {{ item.closeFriday }},
                    Saturday: {{ item.openSaturday }}  {{ item.closeSaturday }},
                    Sunday : {{  item.openSunday }}   {{  item.closeSunday }},

                </v-list-tile-content>
                <v-list-tile-action>

                    <v-btn @click="showDialog(item.id)"> <v-icon color="grey lighten-1">delete_sweep</v-icon> Recycle</v-btn>


                </v-list-tile-action>
            </v-list-tile>
        </v-list>
    </v-flex>

</v-layout>
</template>
<script>
    import axios from 'axios'
    export default {
        name: "CoffeList",
        data(){
            return {
                nearPlace: '',
                snackbar :false,
                dropLocation :[],
                postcodes: [],
                isEditing: true,
                model: null,
                text:'',
                dialog: false,
                FormCups:{
                    Ristretto: '',
                    Espresso : '',
                    Lungo: '',
                    loc_id: ''
                }
            }
        },
        methods:{
            Search(){
                if(this.nearPlace.length > 5){
                    axios.get('location/'+this.nearPlace).then(res=>{
                        console.log(res.data)
                        this.dropLocation = res.data


                    }).catch(res=>{
                        console.log(res)
                    })
                }
            },
            showDialog(loc_id){
                this.FormCups.loc_id  = loc_id
                this.dialog=true
            },
            sendFormCup(){
                console.log(this.FormCups)
                axios.post('/cashback',
                    this.FormCups,
                ).then(res=>{
                    console.log(res.data)
                }).catch(res=>{
                    console.log(res.data)
                })
            },
            closeDialog(){
                this.dialog = false
            }
        },
        beforeCreate() {
            if(localStorage.getItem('api_token') == null) {
                this.$router.push('cp')
            }

        },

    }
</script>

<style scoped>

</style>
