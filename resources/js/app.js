/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
import Swal from "sweetalert2";
import Vue from "vue";
Vue.component('pagination',require('laravel-vue-pagination'));

import VueRouter from "vue-router";

Vue.use(VueRouter);

import Myheader from "./components/Myheader.vue"
import routes from './routes'
window.Swal=Swal

import vSelect from 'vselect-component'

Vue.use(vSelect)

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
window.Toast=Toast


const router = new VueRouter({
    mode: "history",
    routes // short for `routes: routes`
});
const app = new Vue({
    el: "#app",
    router,
    components: {
        Myheader,
    }
});
