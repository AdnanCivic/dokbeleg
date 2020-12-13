<template>
    <div class="card" >
        <div class="card-header"  style="text-align:center"><h3>Verfügbare Bausteine</h3></div>
        <div class="card-body">
            <table class="table">
                <tr><th>Name</th><th>ID</th><th>Nummer</th><th style="text-align: center">Aktion</th></tr>
                <tr v-for="baustein in bausteine" :key="baustein.id"><td>{{ baustein.name }}</td><td>{{ baustein.id }}</td><td>{{ baustein.nummer }}</td>
                    <td style="text-align:center"><a class="btn btn-primary" @click="showBaustein(baustein.id)">Anzeigen</a><a class="btn btn-danger">Löschen</a></td></tr>
            </table>
            <div class="text-center">
                <div :class="{'spinner-border': isLoading}" style="width: 3rem; height: 3rem;"></div>
            </div>
        </div>
    </div>
    <!-- <script src="/js/delete-confirm.js"></script> -->
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

            showBaustein: function(bausteinId){
                console.log(bausteinId);
                
            },
            

        },

        computed: {
            
        }
    }
</script>