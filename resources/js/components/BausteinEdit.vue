<template>
    <div class="card">
        <div class="card-header"><h3>Baustein editieren</h3></div>
        <form id="formEdit" @submit.prevent="onSubmit">
            <div class="form-group row">
                <div class="col">
                    <label for="name" class="label">Name:</label>
                    <input type="textarea" class="form-control" name="name" v-model="baustein.name" placeholder="Namen eingeben..." required autofocus>
                </div>
                <div class="col">
                    <label for="typ" class="label">Typ:</label>
                    <select class="form-control" name="typ" placeholder="Typ auswählen..." :value="baustein.typ" required>
                        <option v-for="(typ, index) in typen" :key="index">{{ typ }}</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="heading" class="label">Überschrift:</label>
                <input type="textarea" class="form-control" name="heading" v-model="baustein.heading" placeholder="Kapitelüberschrift formulieren...">
            </div>
            <div class="form-group">
                <label for="editordata" class="label">Inhalt:</label>

            </div>
            <button type="submit" class="btn btn-primary">Änderungen speichern</button>
        </form>
    </div>
</template>

<script>
import api from '../api/baustein';

export default {
    data(){
        return {
            baustein: {},
            typen: [
                'deckblatt',
                'hauptkapitel',
                'oberkapitel',
                'unterkapitel'
            ],
        }
    },

    created(){
        api.find(this.$route.params.id)
            .then((response) => {
                this.baustein = response.data.data;
            })
            .catch((error) => {
                this.error = error.response.data;
            });
    },

    mounted(){

        console.log(this.baustein.heading);
    },

    methods: {
        onSubmit(){
            // console.log(formatStr);
        // axios in db speichern
            // this.$emit('bausteinsaved');
        },

        showTooltip(){
            
        }
    }
}
</script>

<style>
#formEdit {
    margin: 10px;
}
</style>