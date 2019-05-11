/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
//require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router';
import 'vuetify/dist/vuetify.min.css'
import Vuetify from 'vuetify'
// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.use(VueRouter)
Vue.use(Vuetify)
import CoffeList from './components/CoffeList.vue'
import Login from './components/Login.vue'
import Form from './components/Form.vue'

Vue.component('App', require('./components/App.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const routes = [
    { path: '/', component: CoffeList },
    { path: '/login', component: Login },
    { path: '/', component: Form },
    { path: '/add', component: Form },
    {path: '*' , CoffeList}

]
const router = new VueRouter({
    mode: 'history',
    routes
})
Vue.filter('checkOpen',value=>{

    if(value == ""){
        return 'x'
    }
    else{
        return value+" -"
    }
})
const app = new Vue({
    router,
}).$mount('#app')
