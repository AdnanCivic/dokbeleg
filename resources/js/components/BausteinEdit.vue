<template>
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
                    <input type="textarea" class="form-control" name="name" v-model="baustein.name" required autofocus>
                </div>
                <div class="col">
                    <label for="typ" class="label">Typ:</label>
                    <select class="form-control" name="typ" :value="baustein.typ" required>
                        <option v-for="(typ, index) in typen" :key="index">{{ typ }}</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="heading" class="label">Überschrift:</label>
                <input type="textarea" class="form-control" name="heading" v-model="baustein.heading">
            </div>
            <div class="form-group">
                <label for="editordata" class="label">Inhalt:</label>
                <editor :eingabe-content="this.baustein.content" @contentUpdated="updateBaustein"></editor>
            </div>
            <div class="form-group">
                <button type="submit" :disabled="saving" class="btn btn-primary">Änderungen speichern</button>
            </div>
        </form>
    </div>
</template>

<script>
import api from '../api/baustein';

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
            loaded: false,
            saving: false,
            error: null,
        }
    },

    created(){
        api.find(this.$route.params.id)
            .then((response) => {
                this.baustein = response.data.data;
                this.loaded = true;
            })
            .catch((error) => {
                this.error = error.response.data;
                this.loaded = true;
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
                    setTimeout(() => this.message = null, 1500);
                    this.baustein = response.data.data;
                })
                .catch((error) => {
                    this.error = error.response.data
                })
                .then(() => {
                    setTimeout(() => this.saving = false, 1500);
                });
        },

        reloadComponent(){
            window.location.reload();
        },

        showTooltip(){
            
        }
    }
}
</script>

<style lang="scss" scoped>
#formEdit {
    margin: 10px;
}

.standby {
    background: rgb(129, 226, 129);
    color: black;
    padding: 1rem;
    margin-bottom: 1rem;
    width: 100%;
    border: 1px solid rgb(26, 197, 26);
    border-radius: 5px;
}
</style>