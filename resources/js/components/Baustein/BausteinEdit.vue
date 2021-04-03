<template>
    <transition name="fade" appear>
    <div class="card">
        <div class="card-header"><h3>Baustein editieren</h3></div>
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
                    <input type="textarea" class="form-control" name="name" v-model="baustein.name" required>
                </div>
                <div class="col">
                    <label for="typ" class="label">Typ:</label>
                    <select class="form-control" name="typ" required v-model="baustein.typ">
                        <option v-for="(typ, index) in typen" :key="index" :value="typ">{{ typ }}</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="heading" class="label">Überschrift:</label>
                <input type="textarea" class="form-control" name="heading" v-model="baustein.heading">
            </div>
            <div class="form-group">
                <label for="editordata" class="label">Inhalt:</label>
                <editor name="editordata" :eingabe-content="this.baustein.content" @contentUpdated="updateBaustein"></editor>
            </div>
            <div class="form-group">
                <button type="submit" :disabled="saving" class="btn btn-primary">Änderungen speichern</button>
                <button type="button" class="btn btn-danger" @click.prevent="checkDelete(baustein.id)" :disabled="saving">Baustein löschen</button>
            </div>
        </form>
    </div>
    </transition>
</template>

<script>
import api from '../../api/baustein';

export default {
    data(){
        return {
            baustein: {
                name: '',
                typ: '',
                heading: '',
                content: ''
            },
            typen: [
                'deckblatt',
                'hauptkapitel',
                'oberkapitel',
                'unterkapitel'
            ],
            message: null,
            error: null,
            loaded: false,
            saving: false,
        }
    },

    created(){
        api.find(this.$route.params.id)
            .then((response) => {
                this.baustein = response.data.data;
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
        updateBaustein(updatedContent){
            this.baustein.content = updatedContent;
        },
        onSubmit(){
            this.saving = true;
            api.update(this.baustein.id, this.baustein)
                .then((response) => {
                    this.message = 'Änderungen werden gespeichert!';
                    setTimeout(() => this.message = null, 1000);
                    this.baustein = response.data.data;
                })
                .catch((error) => {
                    this.error = error.response.data
                })
                .finally(() => {
                    setTimeout(() => this.saving = false, 1000);
                    setTimeout(() => this.$router.back(), 1500);
                });
        },
        
        reloadComponent(){
            window.location.reload();
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
                    setTimeout(() => this.message = null, 1000);
                })
                .catch((error) => {
                    this.error = error.response.data
                })
                .finally(() => {
                    setTimeout(() => this.saving = false, 1000);
                    setTimeout(() => this.$router.back(), 1500);
                });
        },

    }
}
</script>

<style scoped>

#formEdit {
    margin: 10px;
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