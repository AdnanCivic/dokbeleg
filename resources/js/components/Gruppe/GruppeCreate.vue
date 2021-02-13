<template>
    <div class="card">
        <div class="card-header"><h3>Gruppe erstellen</h3></div>
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
                    <input type="textarea" class="form-control" name="name" v-model="gruppe.name" placeholder="Namen eingeben..." required autofocus>
                </div>
            </div>
            
            <div class="form-group row">
                <div id="bausteinFeld" class="col alert alert-primary">
                    <h4 style="text-align:center;">Auswahl der Bausteine</h4>
                    <draggable class="list-group" :list="bausteine" group="bausteine" ghost-class="ghost" @start="drag=true" @end="drag=false">
                        <div class="list-group-item" v-for="baustein in bausteine" :key="baustein.id">
                            {{baustein.name}}
                        </div>
                    </draggable> 
                </div>
                <div id="gruppeFeld" class="col alert alert-success">
                    <h4 style="text-align:center;">Neue Gruppe</h4>
                    <draggable class="list-group" :list="bausteinAuswahl" group="bausteine" ghost-class="ghost" @start="drag=true" @end="drag=false">
                        <div class="list-group-item" v-for="(baustein, index) in bausteinAuswahl" :key="index">
                            {{baustein.name}}
                        </div>
                    </draggable>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" :disabled="saving" class="btn btn-primary">Neue Gruppe Speichern</button>
            </div>
        </form>   
    </div>
</template>

<script>
import apiB from '../../api/baustein';
import apiG from '../../api/gruppe';
import draggable from 'vuedraggable';

const getBausteine = (callback) => {
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
    data() {
        return {
            gruppe: {
                name: '',
                bausteinGruppe: [],
            },
            bausteine: [],
            bausteinAuswahl: [],
            message: null,
            error: null,
            saving: false,
            loaded: false,
        }
    },

    beforeRouteEnter(to, from, next) {
        getBausteine((error, data) => {
            next(vm => vm.setData(error, data));
        });
    },

    methods: {
        
        setData(error, data) {
            if (error) {
                this.error = null;
                this.error = error;
                this.loaded = true;
            } else {
                this.error = null;
                this.bausteine = data.data;
                this.loaded = true;
            }
        },
        
        onSubmit(){
            if(this.bausteinAuswahl.length < 1){
                this.message = "Bitte mindestens einen Textbaustein auswählen.";
                setTimeout(() => this.message = null, 1000);
            }else{
                this.error = null;
                this.saving = true;
                this.gruppe.bausteinGruppe = this.bausteinAuswahl;

                apiG.create(this.gruppe)
                    .then((response) => {
                        this.message = "Gruppe wird gespeichert.";
                        setTimeout(() => this.message = null, 1000);
                    })
                    .catch((error) => {
                        this.error = error.response.data;
                    })
                    .finally(() => {
                        setTimeout(() => this.saving = false, 1000);
                        setTimeout(() => this.$router.push({name: 'AlleGruppen'}), 1500);
                    });
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

#bausteinFeld {
    margin: 1rem;
    padding: 1rem;
    border: 1px solid black;
}

#gruppeFeld {
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

.ghost {
  opacity: 0.5;
  background: #fdff87;
}
</style>