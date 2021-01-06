<template>
    <div class="card" >
        <div class="card-header"><h3>Verfügbare Bausteine</h3></div>
        <div class="card-body">
            <table class="table">
                <tr><th>Name</th><th>ID</th><th>Typ</th><th style="text-align: center">Aktion</th></tr>
                <tr v-for="(baustein, index) in bausteine" :key="index"><td>{{ baustein.name }}</td><td>{{ baustein.id }}</td><td>{{ baustein.typ }}</td>
                    <td id="buttons">
                        <router-link class="btn btn-primary" :to="{name: 'BausteinShow', params: { id:baustein.id }}">Anzeigen</router-link>
                        <button type="button" class="btn btn-danger" @click="checkDelete">Löschen</button>
                    </td></tr>
            </table>
            <div class="text-center">
                <div :class="{'spinner-border': isLoading}" style="width: 3rem; height: 3rem;"></div>
            </div>
            <div v-if="error" class="error">
                <p>{{ error }}</p>
                <p><button class="btn btn-success">Erneut versuchen</button></p>
            </div>
            <div class="pagination">
                <button class="btn btn-secondary" :disabled="!prevPage" @click.prevent="goToPrev">Previous</button>
                <button class="btn btn-secondary" :disabled="!nextPage" @click.prevent="goToNext">Next</button>
            </div>
            <div>{{ paginationCount }}</div>
        </div>
    </div>
</template>

<script>
import api from '../api/baustein';

const getBausteine = (page, callback) => {
    const params = { page };
    axios.get('/api/v1/baustein', {params})
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
            isLoading: true,
        }
    },

    beforeRouteEnter(to, from, next){
        const params = { page: to.query.page };
        getBausteine(params, (error, data) => {
            next(vm => vm.setData(error, data));
        });
    },
    
    beforeRouteUpdate(to, from, next) {
        this.bausteine = this.links = this.meta = null;
        getBausteine(to.query.page, (error, data) => {
            this.setData(error, data);
            next();
        });
    },

    methods: {
        
        goToNext(){
            this.$router.push({
                query: {
                    page: this.nextPage,
                },
            });
        },

        goToPrev(){
            this.$router.push({
                query: {
                    page: this.prevPage,
                }
            });
        },

        setData(error, { data: bausteine, links, meta }) {
            if (error) {
                this.error = error;
            } else {
                this.bausteine = bausteine;
                this.links = links;
                this.meta = meta;
            }
        },
        
        checkDelete(){
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

    computed: {
        
        nextPage(){
            if (! this.meta || this.meta.current_page === this.meta.last_page) {
                return;
            }
            return this.meta.current_page + 1;
        },

        prevPage(){
            if (! this.meta || this.meta.current_page === 1) {
                return;
            }
            return this.meta.current_page - 1;
        },

        paginationCount() {
            if (! this.meta) {
                return;
            }
            const { current_page, last_page } = this.meta;
            return `${current_page}` + ` von ` + `${last_page}`;
        },
    }      
}

// loadBausteine: function() {
        //     this.bausteine = this.error = null;
        //     this.isLoading = true;

        //     api.all()
        //         .then((response) => {
        //             this.bausteine = response.data.data;
        //             console.log(response.data);
        //             this.isLoading = false; 
        //         })
        //         .catch((error) => {
        //             this.error = error.message;
        //         })
        //         .finally(()=>{
        //             this.isLoading = false;
        //         });
        // },
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