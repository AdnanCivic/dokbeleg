<template>
    <div class="card">
        <div class="card-header"><h3>Gruppe editieren</h3></div>
        <div v-if="!loaded" style="margin:20px;">
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status"></div>
            </div>
        </div>
        <div v-if="error" class="error" style="margin:20px;">
            <p>{{ error.message }}</p>
            <p><button class="btn btn-success" @click="reloadComponent">Erneut versuchen</button></p>
        </div>
        <div v-if="message" class="standby">{{ message }}</div>
        <form id="formEdit" @submit.prevent="onSubmit">
            <div class="form-group row">
                <div class="col">
                    <label for="name" class="label">Name:</label>
                    <input type="textarea" class="form-control" name="name" v-model="gruppe.name" required autofocus>
                </div>
            </div>
            <div class="form-group row">
                <div id="bausteinFeld" class="col alert alert-secondary feld">
                    <h4 style="text-align:center;">Ohne Zuordnung</h4>
                    <draggable class="list-group" :list="bausteinFeld" group="bausteine" ghost-class="ghost" @start="drag=true" @end="drag=false">
                        <div class="list-group-item" v-for="baustein in bausteinFeld" :key="baustein.id">
                            {{baustein.name}}
                        </div>
                    </draggable>
                </div>
                <div id="gruppeFeld" class="col alert alert-success feld">
                    <h4 style="text-align:center;">Bausteine der Gruppe</h4>
                    <draggable class="list-group" :list="gruppe.bausteinGruppe" group="bausteine" ghost-class="ghost" @start="drag=true" @end="drag=false">
                        <div class="list-group-item" v-for="baustein in gruppe.bausteinGruppe" :key="baustein.id">
                            {{baustein.name}}
                        </div>
                    </draggable> 
                </div>
                <div id="deleteFeld" class="col alert alert-warning feld">
                    <h4 style="text-align:center;">Aus Gruppe entfernen</h4>
                    <draggable class="list-group" :list="deleteFeld" group="bausteine" ghost-class="ghost" @start="drag=true" @end="drag=false">
                        <div class="list-group-item" v-for="(baustein, index) in deleteFeld" :key="index">
                            {{baustein.name}}
                        </div>
                    </draggable>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" :disabled="saving" class="btn btn-primary">Änderungen speichern</button>
                <button type="button" class="btn btn-danger" @click.prevent="checkDelete(gruppe.id)" :disabled="saving">Gruppenzuordnung löschen</button>
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
    data(){
        return {
            gruppe: {
                name: '',
                bausteinGruppe: [],
            },
            bausteinFeld: [],
            deleteFeld: [],
            message: null,
            error: null,
            loaded: false,
            saving: false,
        }
    },

    beforeRouteEnter(to, from, next) {
        getBausteine((error, data) => {
            next(vm => vm.setData(error, data));
        });
    },

    created(){
        apiG.find(this.$route.params.id)
            .then((response) => {
                this.gruppe = response.data.data;
                this.loaded = true;
            })
            .catch((error) => {
                this.loaded = true;
                if(error.response.status == 404){
                    this.$router.push({name: '404'});
                }else{
                    this.error = error.response.data;
                }
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
                this.bausteinFeld= data.data;
                this.loaded = true;
            }
        },

        onSubmit(){
            if(this.gruppe.bausteinGruppe.length < 1){
                this.message = "Bitte mindestens einen Textbaustein auswählen.";
                setTimeout(() => this.message = null, 1000);
            }else{
                this.saving = true;
                apiG.update(this.gruppe.id, this.gruppe)
                    .then((response) => {
                        this.message = 'Änderungen werden gespeichert!';
                        setTimeout(() => this.message = null, 1000);
                        this.gruppe = response.data.data;
                    })
                    .catch((error) => {
                        this.error = error.response.data
                    })
                    .finally(() => {
                        setTimeout(() => this.saving = false, 1000);

                    });
            }
        },
    },
}
</script>

<style scoped>

#formEdit {
    margin: 10px;
}

.feld{
    height: 25rem;
    margin: 1rem;
    margin-bottom: 1rem;
    padding: 1rem;
    border: 1px solid black;
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