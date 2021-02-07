require('./bootstrap');
require('./api/api-cookie');
import Vue from 'vue';
import router from './router/router';
import routerDok from './router/routerDok';
import routerGru from './router/routerGru';
import 'nprogress/nprogress.css';

Vue.component('button-link', require('./components/ButtonLink.vue').default);
Vue.component('editor', require('./components/Editor.vue').default);

const app = new Vue({
    el: '#app',
    router: router,
    data: {
        
    },
});

const dok = new Vue({
    el: '#dok',
    router: routerDok,
    data: {
        
    },
});

const gru = new Vue({
    el: '#gru',
    router: routerGru,
    data: {

    },
});