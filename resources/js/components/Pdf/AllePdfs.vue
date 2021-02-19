<template>
    <div class="card" >
        <div class="card-header"><h3>PDF-Dokumente</h3></div>
        <div class="card-body">
            <table class="table table-sm">
                <tr><th>Name</th><th>PDF-ID</th><th>Anzahl Gruppen</th><th style="text-align: center">Aktion</th></tr>
                    <tr v-for="(pdf, index) in pdfs" :key="index">
                        <td>{{ pdf.name }}</td><td>{{ pdf.id }}</td><td>{{ pdf.anzahlGruppen }}</td>
                        
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
            

        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return {
            pdfs: [],
            loaded: false,
            error: null,

        }
    },

    created(){
        axios.get('/api/v1/dokument/pdf/')
            .then((response) => {
                console.log(response);
            })
            .catch((error) => {
                console.log(error.response);
            });
    },
}

</script>

<style scoped>

</style>