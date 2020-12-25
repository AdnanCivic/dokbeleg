require('./bootstrap');

$(document).ready(function(){
    $('#summernote').summernote();
});

window.Vue = require('vue');

Vue.component('alle-bausteine', require('./components/AlleBausteine.vue').default);
Vue.component('button-link', require('./components/ButtonLink.vue').default);
Vue.component('summer-note', require('./components/SummerNote.vue').default);


const app = new Vue({
    el: '#app',
    data() {
        return {
            
        }
    },
});
