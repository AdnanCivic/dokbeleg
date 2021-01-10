require('./bootstrap');
import Vue from 'vue';
import router from './router';
import 'nprogress/nprogress.css';

Vue.component('button-link', require('./components/ButtonLink.vue').default);
// Vue.component('alle-bausteine', require('./components/AlleBausteine.vue').default);
// Vue.component('summer-note', require('./components/SummerNote.vue').default);

const app = new Vue({
    el: '#app',
    router: router,
    data: {
        
    },
    methods: {
        savemessage(){
            alert('Baustein wurde gespeichert.');
        },

        doit(){
            alert('work');
        }
    }
});