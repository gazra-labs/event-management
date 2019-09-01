/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue';
import VueAxios from 'vue-axios';
import axios from 'axios';
import * as moment from "moment";
// Vue.use(moment)
//console.log(moment().format("YYYY"));

import App from './App.vue';


Vue.component('example-component', require('./components/ExampleComponent.vue'));


Vue.use(VueAxios, axios);

const routes = [
    // {
    //     name: 'App',
    //     path: '/calendar',
    //     // component: App
    // }
];
  
// const router = new VueRouter({ mode: 'history', routes: routes});
var calendar = document.getElementById('calendarApp')
if(calendar!=null){
    new Vue(App).$mount('#calendarApp');
}
require('./bootstrap');
