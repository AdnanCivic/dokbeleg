<template>
    <div class="card">
        <div class="card-header" v-if="baustein"><h3>Baustein: {{ baustein.name }}</h3></div>
        <summer-note></summer-note>
    </div>
</template>

<script>

import SummerNote from './SummerNote.vue';

    export default {
        components: { 
            SummerNote 
        },

        data(){
            return {
                baustein: null,
                bausteinId: null,
                error: null,
            }
        },

        // beforeRouteEnter (to, from, next) {
        //     getBaustein(to.params.id, (err, baustein) => {
        //         next(vm => vm.setData(err, baustein))
        //     })
        // },

        created(){
            // this.loadBaustein();
        },

        methods: {
            // loadBaustein: function() {
            //     this.baustein = this.error = null;
            //     this.bausteinId = this.$route.params.id;
            //     axios.get('/api/v1/baustein/' + this.bausteinId)
            //         .then((response) => {
            //             this.baustein = response.data.data;
            //         })
            //         .catch((error) => {
            //             this.error = error.message;
            //         });
            // },         
        }  
    }

</script>