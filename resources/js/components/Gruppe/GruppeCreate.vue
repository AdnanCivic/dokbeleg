<template>
    <div class="card">
        <div class="card-header"><h3>Gruppe erstellen</h3></div>
        <div v-if="error" class="error" style="margin:20px;">
            <p>{{ error.message }}</p>
            <p>Bitte erneut versuchen.</p>
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
                <div class="col">
                    <draggable v-model="bausteine" group="people" @start="drag=true" @end="drag=false">
                        <div v-for="baustein in bausteine" :key="baustein.id">{{baustein.name}}</div>
                    </draggable>
                </div>
                <div class="col">
                    <draggable v-model="neuGruppe" group="people" @start="drag=true" @end="drag=false">
                        
                    </draggable>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" :disabled="saving" class="btn btn-primary">Speichern</button>
            </div>
        </form>   
    </div>
</template>

<script>
import api from '../../api/gruppe';
import draggable from 'vuedraggable';

export default {
    components: {
        draggable
    },
    data() {
        return {
            gruppe: {
                name: '',
            },
            bausteine: [
                { name: 'Januar', id: 1},
                { name: 'Februar', id: 2},
            ],
            neuGruppe: [

            ],
            message: null,
            error: null,
            saving: false,
        }
    },

    methods: {
        onSubmit(){
            this.error = null;
            this.saving = true;
            api.create(this.gruppe)
                .then((response) => {
                    this.message = "Gruppe wird gespeichert.";
                    setTimeout(() => this.message = null, 1000);
                    this.gruppe = response.data.data;
                })
                .catch((error) => {
                    this.error = error.response.data;
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
#formCreate {
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