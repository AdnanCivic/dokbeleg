<template>
    <div class="card">
        <div class="card-header"><h3>Dokument erstellen</h3></div>
        <div v-if="error" class="error" style="margin:20px;">
            <p>{{ error.message }}</p>
            <p><button class="btn btn-success" @click="reloadComponent">Erneut versuchen</button></p>
        </div>
        <div v-if="!loaded" style="margin:20px;">
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status"></div>
            </div>
        </div>
        <div v-if="message" class="standby">{{ message }}</div>
        <form id="formCreate" @submit.prevent="onSubmit">
            <div class="form-group row">
                <div class="col">
                    <label for="name" class="label">Name:</label>
                    <input type="textarea" class="form-control" name="name" v-model="dokument.name" placeholder="Namen eingeben..." required autofocus>
                </div>
            </div>
            
            <div class="form-group row">
                <div id="gruppeFeld" class="col alert alert-primary">
                    <h4 style="text-align:center;">Auswahl der Gruppen</h4>
                    <draggable class="list-group" :list="gruppen" group="gruppen" ghost-class="ghost" @start="drag=true" @end="drag=false">
                        <div class="list-group-item" v-for="gruppe in gruppen" :key="gruppe.id">
                            {{gruppe.name}}
                        </div>
                    </draggable> 
                </div>
                <div id="dokumentFeld" class="col alert alert-success">
                    <h4 style="text-align:center;">Neues Dokument</h4>
                    <draggable class="list-group" :list="gruppeAuswahl" group="gruppen" ghost-class="ghost" @start="drag=true" @end="drag=false">
                        <div class="list-group-item" v-for="(gruppe, index) in gruppeAuswahl" :key="index">
                            {{gruppe.name}}
                        </div>
                    </draggable>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" :disabled="saving" class="btn btn-primary">Neues Dokument Speichern</button>
            </div>
        </form>   
    </div>
</template>

<script>
import apiG from '../../api/gruppe';
import draggable from 'vuedraggable';

const getGruppen = (callback) => {
    const params =  { gruppe: 1};
    apiB.all(params)
        .then(response => {
            callback(null, response.data);})
        .catch(error => {
            callback(error, error.response.data);
    });
};

export default {
    components: {
        draggable
    },
    data(){
        return {
            dokument: {
                name: '',
                gruppenDokument: [],
            },
            gruppen: [],
            gruppeAuswahl: [],
            error: null,
            message:null,
            saving: false,
            loaded: false

        }
    },
    methods:{
        onSubmit(){

        },

        reloadComponent(){

        },
    }
}
</script>

<style scoped>

#formCreate {
    margin: 1rem;
}

</style>