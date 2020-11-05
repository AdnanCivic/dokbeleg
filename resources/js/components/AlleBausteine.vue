<template>
    <main class="container" style="padding-top:70px;">
        <!-- <div><a class="btn btn-primary btn-large" href="{{ route('home') }}">Zurück</a></div> -->
        <div class="card">
            <div class="card-header"  style="text-align:center"><h3>Verfügbare Bausteine</h3></div>
            <div class="card-body">
                <table class="table">
                    <tr><th>Name</th><th>ID</th><th>Nummer</th><th style="text-align: center">Aktion</th></tr>
                    <tr v-for="(baustein, index) in bausteine" :key="index"><td>{{ baustein.name }}</td><td>{{ baustein.id }}</td><td>{{ baustein.nummer }}</td>
                        <td style="text-align:center"><button class="btn btn-primary" v-on:click="dinge()">Anzeigen</button><button class="btn btn-danger">Löschen</button></td></tr>
                </table>
            </div>
        </div>     
    </main>
</template>

<script>
    export default {
        data: function(){
            return {
                bausteine: [],
            }
        },

        mounted() {
            this.loadBausteine();
        },

        methods: {
            loadBausteine: function() {
                axios.get('http://api.dokbeleg.de/v1/baustein')
                    .then((response) => {
                        this.bausteine = response.data.data;
                    })
                    .catch(function(error){
                        console.log(error);
                    });
            },

            dinge: function(){
                alert('hey');
            }
        }
    }
</script>
