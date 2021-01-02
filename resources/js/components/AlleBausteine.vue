<template>
    <div class="card" >
        <div class="card-header"><h3>Verfügbare Bausteine</h3></div>
        <div class="card-body">
            <table class="table">
                <tr><th>Name</th><th>ID</th><th>Typ</th><th style="text-align: center">Aktion</th></tr>
                <tr v-for="(baustein, index) in bausteine" :key="index"><td>{{ baustein.name }}</td><td>{{ baustein.id }}</td><td>{{ baustein.typ }}</td>
                    <td id="buttons">
                        <router-link class="btn btn-primary" :to="{name: 'BausteinShow', params: { id:baustein.id}}">Anzeigen</router-link>
                        <button type="button" class="btn btn-danger" @click="checkDelete">Löschen</button>
                    </td></tr>
            </table>
            <div class="text-center">
                <div :class="{'spinner-border': isLoading}" style="width: 3rem; height: 3rem;"></div>
            </div>
            <div v-if="error" class="error">
                <p>{{ error }}</p>
                <p><button class="btn btn-success" @click="loadBausteine">Erneut versuchen</button></p>
            </div>
        </div>
    </div>
</template>

<script>
    const getUsers = (page, callback) => {
    const params = { page };
    axios
        .get('/api/users', { params })
        .then(response => {
            callback(null, response.data);
        }).catch(error => {
            callback(error, error.response.data);
        });
    };
    
    export default {
        data(){
            return {
                bausteine: null,
                error: null,
                isLoading: false,
            }
        },

        beforeRouteEnter(to, from, next){
            getPost(to.params.id, (err, post) => {
            next(vm => vm.setData(err, post));
            });
        },

        created(){
            // console.log(this.$route);
            this.loadBausteine();
        },

        watch: {
            '$route': 'loadBausteine',
        },

        methods: {
            loadBausteine: function() {
                this.bausteine = this.error = null;
                this.isLoading = true;
                axios.get('/api/v1/baustein')
                    .then((response) => {
                        this.bausteine = response.data.data;
                        this.isLoading = false; 
                    })
                    .catch((error) => {
                        this.error = error.message;
                    })
                    .finally(()=>{
                        this.isLoading = false;
                    });
            },
            
            checkDelete: function(){
                var auswahl = confirm('Soll der Baustein gelöscht werden?');
                if(auswahl) {
                    this.deleteBaustein();
                }
            },

            deleteBaustein: function(){
                //baustein löschen
                //alert message
                alert('Baustein gelöscht.');
            },
        },       
    }
 
</script>

<style>
    .error {
        text-align: center;
        color: red;
    }
    .card-header {
        text-align: center;
    }
    #buttons {
        text-align: center;
    }
</style>