require('./bootstrap');
import VueRouter from 'vue-router';
import routes from './routes';

$(document).ready(function(){
    $('#summernote').summernote();
});

window.Vue = require('vue');

Vue.use(VueRouter);

Vue.component('alle-bausteine', require('./components/AlleBausteine.vue').default);
Vue.component('button-link', require('./components/ButtonLink.vue').default);
Vue.component('summer-note', require('./components/SummerNote.vue').default);


const app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
    data() {
        return {
            
        }
    },
    methods: {
        doit: function(){
            alert('work');
        }
    }
});
