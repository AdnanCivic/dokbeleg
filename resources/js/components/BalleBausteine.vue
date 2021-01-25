<template>
    <div class="card" >
        <div class="card-header"><h3> Test Verfügbare Bausteine</h3></div>
        <div class="card-body"><table class="table">
                <tr><th>Name</th><th>ID</th><th>Typ</th><th style="text-align: center">Aktion</th></tr>
                <tr v-for="(baustein, index) in bausteine" :key="index"><td>{{ baustein.name }}</td><td>{{ baustein.id }}</td><td>{{ baustein.typ }}</td>
                <td id="buttons"><router-link class="btn btn-primary" :to="{name: 'BausteinShow', params: { id:baustein.id }}">Anzeigen</router-link>
                <button type="button" class="btn btn-danger">Löschen</button></td></tr>
            </table>
            <div v-if="error" class="error"><p>{{ error }}</p></div>
            <div class="pagination">
                <button :disabled="!prevPage" @click.prevent="goToPrev">Previous</button>
                <button :disabled="!nextPage" @click.prevent="goToNext">Next</button>
            </div>
        </div>
    </div>
</template>

<script>

const getBausteine = (page, callback) => {
    const params = { page };
    console.log(' ---> getBausteine called');
    console.log(JSON.stringify(params) + ' getBausteine');
    axios.get('/api/v1/baustein', {params})
        .then(response => {
            console.log(response.data);
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
            links: {
                first: null,
                last: null,
                next: null,
                prev: null
            },
            meta: null,
            isLoading: false,
        }
    },

    beforeRouteEnter(to, from, next){
        // to.query.page= 2;
        const params = { page: to.query.page };
        getBausteine(params, (error, data) => {
            next(vm => vm.setData(error, data));
        });
        
    },

    beforeRouteUpdate(to, from, next){
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
    }      
}
</script>