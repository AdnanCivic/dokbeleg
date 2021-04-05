import Vue from 'vue';
import router from './router/router.js';

try {
    window._ = require('lodash');
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    require('bootstrap/dist/js/bootstrap.js');
    require('bootstrap/dist/css/bootstrap.css');
} catch (e) {}

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.withCredentials = true;

var pdfMake = require("pdfmake/build/pdfmake.js");
var pdfFonts = require("pdfmake/build/vfs_fonts.js");
pdfMake.vfs = pdfFonts.pdfMake.vfs;

Vue.component('button-link', require('./components/ButtonLink.vue').default);
Vue.component('editor', require('./components/Editor.vue').default);
Vue.component('pdf-modal', require('./components/PdfModal.vue').default);

const app = new Vue({
    el: '#app',
    router: router,
});