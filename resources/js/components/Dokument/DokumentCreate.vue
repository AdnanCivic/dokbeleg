<template>
    <transition name="fade" appear>
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
    </transition>
</template>

<script>
import apiG from '../../api/gruppe';
import apiD from '../../api/dokument';
import draggable from 'vuedraggable';

const getGruppen = (callback) => {
    const params =  { gruppe: 1};
    apiG.all(params)
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

    beforeRouteEnter(to, from, next) {
        getGruppen((error, data) => {
            next(vm => vm.setData(error, data));
        });
    },

    methods:{
        setData(error, data) {
            if (error) {
                this.error = null;
                this.error = error;
                this.loaded = true;
            } else {
                this.error = null;
                this.gruppen = data.data;
                this.loaded = true;
            }
        },
        
        onSubmit(){
            if(this.gruppeAuswahl.length < 1){
                this.message = "Bitte mindestens eine Gruppe auswählen.";
                setTimeout(() => this.message = null, 1000);
            }else{
                const deckblattIndex = this.gruppeAuswahl.findIndex((gruppe) => gruppe.hasDeckblatt == true);
                if(deckblattIndex > 0){
                    this.saving = true;
                    this.message = 'Eine Gruppe mit dem Baustein Deckblatt muss an erster Position stehen.';
                    setTimeout(() => this.message = null, 1500);
                    setTimeout(() => this.saving = false, 1500);
                }else if(deckblattIndex < 0){
                    this.saving = true;
                    this.message = 'Es fehlt eine Gruppe mit dem Baustein Deckblatt.';
                    setTimeout(() => this.message = null, 1500);
                    setTimeout(() => this.saving = false, 1500);
                }else{
                    this.error = null;
                    this.saving = true;
                    this.dokument.gruppenDokument = this.gruppeAuswahl;

                    apiD.create(this.dokument)
                        .then((response) => {
                            this.message = "Dokument wird gespeichert.";
                            setTimeout(() => this.message = null, 1000);
                        })
                        .catch((error) => {
                            this.error = error.response.data;
                        })
                        .finally(() => {
                            setTimeout(() => this.saving = false, 1000);
                            setTimeout(() => this.$router.push({name: 'AlleDokumente'}), 1500);
                        });
                }   
            }
        },

        reloadComponent(){
            window.location.reload();
        },
    }
}
</script>

<style scoped>

#formCreate {
    margin: 1rem;
}

#gruppeFeld, #dokumentFeld {
    margin: 1rem;
    padding: 1rem;
    border: 1px solid black;
}

.list-group{
    height: 20rem;
    margin-bottom: 1rem;
    overflow: scroll;
    -webkit-overflow-scrolling: touch;
}

.ghost {
  opacity: 0.5;
  background: #fdff87;
}

.standby {
background: rgb(129, 226, 129);
color: black;
text-align: center;
padding: 1rem;
margin-bottom: 1rem;
width: 100%;
border: 1px solid rgb(26, 197, 26);
border-radius: 5px;
}

</style>