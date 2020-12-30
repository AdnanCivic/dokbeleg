<template>
    <div class="card">
        <div class="card-header"><h3>Baustein: {{ baustein.name }}</h3></div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                baustein: {},
                bausteinId: null,
                error: null,
            }
        },

        created(){
            this.loadBaustein();
        },

        methods: {
            
            loadBaustein: function() {
                this.bausteinId = this.$route.params.id;
                // console.log('https://dokbeleg.de/api/v1/baustein/' + this.bausteinId);
                axios.get('/api/v1/baustein/' + this.bausteinId)
                    .then((response) => {
                        this.baustein = response.data.data;
                    })
                    .catch((error) => {
                        this.error = error.message;
                    });
            }
                
        }
        
    }
</script>