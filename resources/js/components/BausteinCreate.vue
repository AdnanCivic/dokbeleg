<template>
    <div class="card">
        <div class="card-header"><h3>Baustein erstellen</h3></div>
        <form id="formCreate" @submit.prevent="onSubmit">
            <div class="form-group row">
                <div class="col">
                    <label for="name" class="label">Name:</label>
                    <input type="textarea" class="form-control" name="name" v-model="baustein.name" placeholder="Namen eingeben..." required autofocus>
                </div>
                <div class="col">
                    <label for="typ" class="label">Typ:</label>
                    <select class="form-control" name="typ" placeholder="Typ auswählen..." required @mouseover="showTooltip">
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
            </div>
            <button type="submit" class="btn btn-primary">Speichern</button>
        </form>
        
    </div>
</template>

<script>
export default {
    data() {
        return {
            baustein: {},
            typen: [
                    'deckblatt',
                    'inhaltsverzeichnis',
                    'hauptkapitel',
                    'oberkapitel',
                    'unterkapitel'
            ],
        }
    },

    methods: {
        onSubmit(){
            console.log(formatStr);
        },

        showTooltip: function(){
            console.log('info');
        }
    }

    
}
</script>

<style>
#formCreate {
    margin: 10px;
}
.label {
    color: blue;
}
</style>