<template>
    <div class="card" >
        <div class="card-header"><h3>PDF-Dokumente</h3></div>
        <div class="card-body">
            <table class="table table-sm">
                <tr><th>Name</th><th>PDF-ID</th><th>Anzahl Gruppen</th><th style="text-align: center">Aktion</th></tr>
                    <tr v-for="(pdf, index) in pdfs" :key="index">
                        <td>{{ pdf.name }}</td><td>{{ pdf.id }}</td><td>{{ pdf.anzahlGruppen }}</td>
                        <td id="buttons">
                            <router-link class="btn btn-primary btn-sm" :to="{name: 'PdfEdit', params: { id:pdf.id }}">Anzeigen</router-link>
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
                <router-link class="btn btn-secondary" tag="button" :disabled="!prevPage" :to="{name: 'AllePdfs', query: { page: this.prevPage}}">Zurück</router-link>
                <router-link class="btn btn-secondary" tag="button" :disabled="!nextPage" :to="{name: 'AllePdfs', query: { page: this.nextPage}}">Weiter</router-link>
            </div>
            <div>{{ paginationCount }}</div>

        </div>
    </div>
</template>

<script>
import api from '../../api/pdf';

const getPdfs = (page, dok_id, callback) => {
    const params =  { page };
    api.all(params, dok_id)
        .then(response => {
            callback(null, response.data);})
        .catch(error => {
            callback(error, error.response.data);
    });
};

export default {
    data(){
        return {
            pdfs: null,
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
            getPdfs(to.query.page, from.params.id, (error, data) => {
                next(vm => vm.setData(error, data));
            });
        }else{
            const params = { page: to.query.page };
            getPdfs(params, from.params.id, (error, data) => {
                next(vm => vm.setData(error, data));
            });
        }
    },

    beforeRouteUpdate(to, from, next) {
        this.pdfs = this.links = this.meta = null;
        getPdfs(to.query.page, from.params.id, (error, data) => {
            this.setData(error, data);
            next();
        });
    },

    methods: {
        setData(error, { data: pdfs, links, meta }) {
            if (error) {
                this.error = null;
                this.error = error;
                this.loaded = true;
            } else {
                this.error = null;
                this.pdfs = pdfs;
                this.links = links;
                this.meta = meta;
                this.loaded = true;
            }
        },
        
        reloadComponent(){
            window.location.reload();
        }
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