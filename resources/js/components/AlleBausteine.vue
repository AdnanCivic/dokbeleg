<template>
    <div class="card" >
        <div class="card-header"  style="text-align:center"><h3>Verfügbare Bausteine</h3></div>
        <div class="card-body">
            <table class="table">
                <tr><th>Name</th><th>ID</th><th>Nummer</th><th style="text-align: center">Aktion</th></tr>
                <tr v-for="(baustein, index) in bausteine" :key="index"><td>{{ baustein.name }}</td><td>{{ baustein.id }}</td><td>{{ baustein.nummer }}</td>
                    <td style="text-align:center"><a class="btn btn-primary">Anzeigen</a><a class="btn btn-danger">Löschen</a></td></tr>
            </table>
            <div class="text-center">
                <div :class="{'spinner-border': isLoading}" style="width: 3rem; height: 3rem;"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                bausteine: [],
                isLoading: true
            }
        },

        mounted(){
            this.loadBausteine();
        },

        methods: {
            loadBausteine: function() {
                axios.get('http://dokbeleg.de/api/v1/baustein')
                    .then((response) => {
                        this.bausteine = response.data.data;
                        this.isLoading = false;
                        
                    })
                    .catch(function(error){
                        console.log(error);
                    })
                    .finally(()=>{
                        this.isLoading = false;
                    });
            },

        },

        computed: {
            
        }
    }
</script>