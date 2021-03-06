require('./bootstrap');
require('./api/api-cookie');
import Vue from 'vue';
import router from './router/router.js';
import routerDok from './router/routerDok.js';
import routerGru from './router/routerGru.js';
import 'nprogress/nprogress.css';

Vue.component('button-link', require('./components/ButtonLink.vue').default);
Vue.component('editor', require('./components/Editor.vue').default);
Vue.component('pdf-modal', require('./components/PdfModal.vue').default);

const app = new Vue({
    el: '#app',
    router: router,
});

const dok = new Vue({
    el: '#dok',
    router: routerDok,
});

const gru = new Vue({ 
    el: '#gru',
    router: routerGru,
});