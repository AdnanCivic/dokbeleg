<template>
    <div class="card" >
        <div class="card-header"><h3>Verfügbare Gruppen</h3></div>
        <div class="card-body">
            <table class="table table-sm">
                <tr><th>Name</th><th>Dokument-ID</th><th>Dokument-Position</th><th>Anzahl Bausteine</th><th style="text-align: center">Aktion</th></tr>
                    <tr v-for="(gruppe, index) in gruppen" :key="index">
                        <td>{{ gruppe.name }}</td><td>{{ gruppe.dokument_id }}</td><td>{{ gruppe.dokument_pos }}</td><td>{{ gruppe.anzahlBausteine}}</td>
                        <td id="buttons">
                            <router-link class="btn btn-primary btn-sm" :to="{name: 'GruppeEdit', params: { id:gruppe.id }}">Anzeigen</router-link>
                        </td>
                    </tr>
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
                <router-link class="btn btn-secondary" tag="button" :disabled="!prevPage" :to="{name: 'AlleGruppen', query: { page: this.prevPage}}">Zurück</router-link>
                <router-link class="btn btn-secondary" tag="button" :disabled="!nextPage" :to="{name: 'AlleGruppen', query: { page: this.nextPage}}">Weiter</router-link>
            </div>
            <div>{{ paginationCount }}</div>
        </div>
    </div>
</template>

<script>
import api from '../../api/gruppe';

const getGruppen = (page, callback) => {
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
            gruppen: null,
            error: null,
            links: {
                first: null,
                last: null,
                next: null,
                prev: null
            },
            meta: null,
            loaded: false,
        }
    },

    beforeRouteEnter(to, from, next) {
        if(to.query !== 0){
            getGruppen(to.query.page, (error, data) => {
                next(vm => vm.setData(error, data));
            });
        }else{
            const params = { page: to.query.page };
            getGruppen(params, (error, data) => {
                next(vm => vm.setData(error, data));
            });
        }
    },

    beforeRouteUpdate(to, from, next) {
        this.gruppen = this.links = this.meta = null;
        getGruppen(to.query.page, (error, data) => {
            this.setData(error, data);
            next();
        });
    },

    methods: {
        setData(error, { data: gruppen, links, meta }) {
            if (error) {
                this.error = null;
                this.error = error;
                this.loaded = true;
            } else {
                this.error = null;
                this.gruppen = gruppen;
                this.links = links;
                this.meta = meta;
                this.loaded = true;
            }
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

<style scoped>

</style>