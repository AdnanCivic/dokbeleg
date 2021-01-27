<template>
    <div class="card" >
        <div class="card-header"><h3>Verfügbare Bausteine</h3></div>
        <div class="card-body">
            <div v-if="message" class="standby">{{ message }}</div>
            <table class="table">
                <tr><th>Name</th><th>ID</th><th>Typ</th><th style="text-align: center">Aktion</th></tr>
                
                <tr v-for="(baustein, index) in bausteine" :key="index"><td>{{ baustein.name }}</td><td>{{ baustein.id }}</td><td>{{ baustein.typ }}</td>
                    <td id="buttons">
                        <router-link class="btn btn-primary btn-sm" :to="{name: 'BausteinEdit', params: { id:baustein.id }}">Anzeigen</router-link>
                        <button type="button" class="btn btn-danger btn-sm" @click.prevent="checkDelete(baustein.id)" :disabled="saving">Löschen</button>
                    </td></tr>
            </table>
            <div v-if="!loaded">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status"></div>
                </div>
            </div>
            <div v-if="error" class="error">
                <p>{{ error.message }}</p>
                <p><button class="btn btn-success" @click="reloadComponent">Erneut versuchen</button></p>
            </div>
            <div>
                <router-link class="btn btn-secondary" tag="button" :disabled="!prevPage" :to="{name: 'AlleBausteine', query: { page: this.prevPage}}">Zurück</router-link>
                <router-link class="btn btn-secondary" tag="button" :disabled="!nextPage" :to="{name: 'AlleBausteine', query: { page: this.nextPage}}">Weiter</router-link>
            </div>
            <div>{{ paginationCount }}</div>
        </div>
    </div>
</template>

<script>
import api from '../api/baustein';

const getBausteine = (page, callback) => {
    const params =  { page };
    api.all(params)
        .then(response => {
            callback(null, response.data);})
        .catch(error => {
            callback(error, error.response.data);
    });
};

export default {
    data(){
        return {
            bausteine: null,
            error: null,
            links: {
                first: null,
                last: null,
                next: null,
                prev: null
            },
            meta: null,
            message: null,
            loaded: false,
            saving: false,
        }
    },

    beforeRouteEnter(to, from, next) {
        if(to.query !== 0){
            getBausteine(to.query.page, (error, data) => {
                next(vm => vm.setData(error, data));
            });
        }else{
            const params = { page: to.query.page };
            getBausteine(params, (error, data) => {
                next(vm => vm.setData(error, data));
            });
        }
    },
    
    beforeRouteUpdate(to, from, next) {
        this.bausteine = this.links = this.meta = null;
        getBausteine(to.query.page, (error, data) => {
            this.setData(error, data);
            next();
        });
    },

    methods: {

        setData(error, { data: bausteine, links, meta }) {
            if (error) {
                this.error = error;
                this.loaded = true;
            } else {
                this.bausteine = bausteine;
                this.links = links;
                this.meta = meta;
                this.loaded = true;
            }
        },
        
        checkDelete(id){
            var auswahl = confirm('Soll der Baustein gelöscht werden?');
            if(auswahl) {
                this.deleteBaustein(id);
            }
        },

        deleteBaustein(id){
            this.message = null;
            this.saving = true;
            api.delete(id)
                .then(() => {
                    this.message = "Baustein wird entfernt.";
                    setTimeout(() => this.message = null, 1500);
                })
                .catch((error) => {
                    this.error = error.response.data
                })
                .finally(() => {
                    setTimeout(() => this.saving = false, 1500);
                });
        },

        reloadComponent(){
            window.location.reload();
        },
    },

    computed: {
        
        nextPage(){
            if (!this.meta || this.meta.current_page === this.meta.last_page) {return;}

            return this.meta.current_page + 1;
        },

        prevPage(){
            if (!this.meta || this.meta.current_page === 1) {return;}

            return this.meta.current_page - 1;
        },

        paginationCount() {
            if (! this.meta) {return;}

            const { current_page, last_page } = this.meta;

            return `Seite ${current_page} von ${last_page}`;
        },
    }      
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
.label {
color: blue;
}
.standby {
background: rgb(129, 226, 129);
color: black;
padding: 1rem;
margin-bottom: 1rem;
width: 100%;
border: 1px solid rgb(26, 197, 26);
border-radius: 5px;
}
</style>