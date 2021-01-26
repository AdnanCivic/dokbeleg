<template>
    <div class="card">
        <div class="card-header"><h3>Baustein erstellen</h3></div>
        <div v-if="error" class="error" style="margin:20px;">
            <p>{{ error.message }}</p>
            <p>Erneut versuchen</p>
        </div>
        <div v-if="message" class="standby">{{ message }}</div>
        <form id="formCreate" @submit.prevent="onSubmit">
            <div class="form-group row">
                <div class="col">
                    <label for="name" class="label">Name:</label>
                    <input type="textarea" class="form-control" name="name" v-model="baustein.name" placeholder="Namen eingeben..." required autofocus>
                </div>
                <div class="col">
                    <label for="typ" class="label">Typ:</label>
                    <select class="form-control" name="typ" placeholder="Typ auswählen..." v-model="baustein.typ" required>
                        <option v-for="(typ, index) in typen" :key="index">{{ typ }}</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="heading" class="label">Überschrift:</label>
                <input type="textarea" class="form-control" name="heading" v-model="baustein.heading" placeholder="Kapitelüberschrift formulieren...">
            </div>
            <div class="form-group">
                <label for="editor" class="label">Inhalt:</label>
                <editor name="editor" @contentUpdated="updateBaustein"></editor>
            </div>
            <div class="form-group">
                <button type="submit" :disabled="saving" class="btn btn-primary">Speichern</button>
            </div>
        </form>
        
    </div>
</template>

<script>
import api from '../api/baustein';

export default {
    data() {
        return {
            baustein: {
                name: '',
                typ: '',
                heading: '',
                content: '',
            },
            typen: [
                    'deckblatt',
                    'hauptkapitel',
                    'oberkapitel',
                    'unterkapitel'
            ],
            message: null,
            error: null,
            saving: false,
        }
    },

    methods: {
        updateBaustein(updatedContent){
            this.baustein.content = updatedContent;
        },
        onSubmit(){
            this.saving = true;
            api.create(this.baustein)
                .then((response) => {
                    this.baustein = response.data.data;
                })
                .catch((error) => {
                    this.error = error.response.data;
                })
                .finally(() => {
                    this.saving = false;
                });
        },

    }

    
}
</script>

<style scoped>
    #formCreate {
        margin: 10px;
    }
</style>