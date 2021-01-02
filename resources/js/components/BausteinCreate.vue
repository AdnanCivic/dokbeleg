<template>
    <div class="card">
        <div class="card-header"><h3>Baustein erstellen</h3></div>
        <form id="form" @submit.prevent="neuerBaustein">
            <div class="form-group row">
                <div class="col">
                    <label for="name">Name:</label>
                    <input type="textarea" class="form-control" name="name" v-model="baustein.name" placeholder="Namen eingeben..." required autofocus>
                </div>
                <div class="col">
                    <label for="typ">Typ:</label>
                    <input type="textarea" class="form-control" name="typ" v-model="baustein.typ" placeholder="Typ auswählen..." required @mouseover="showTooltip">
                </div>
            </div>
            <div class="form-group">
                <label for="heading">Überschrift:</label>
                <input type="textarea" class="form-control" name="heading" v-model="baustein.heading" placeholder="Kapitelüberschrift formulieren...">
            </div>
            <div class="form-group">
                <label for="editor">Inhalt:</label>
                <summer-note name="editor"></summer-note>
            </div>
            <button type="submit" class="btn btn-primary">Speichern</button>
        </form>
        
    </div>
</template>

<script>
import SummerNote from './SummerNote.vue'
export default {
    
    components: { 
        SummerNote 
    },

    data() {
        return {
            baustein: {
                name: '',
                typ: '',
                heading: '',
                content: ''
            }
        }
    },

    methods: {
        neuerBaustein: function(){
            var content = $('#summernote').summernote('code');


            console.log(formatStr);
        },

        showTooltip: function(){
            console.log('info');
        }
    }

    
}
</script>

<style>
#form {
    margin: 10px;
}
div > label {
    color: blue;
}
</style>