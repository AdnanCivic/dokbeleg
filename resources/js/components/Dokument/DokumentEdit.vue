<template>
<div>
    <pdf-modal>
        <template #modal-content><iframe id="document"></iframe></template>
    </pdf-modal>
    <div class="card">
        
        <div class="card-header"><h3>Dokument editieren</h3></div>
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
                    <input type="textarea" class="form-control" name="name" v-model="dokument.name" required autofocus>
                </div>
            </div>
            <div class="form-group row">
                <div id="gruppeFeld" class="col alert alert-secondary feld">
                    <h4 style="text-align:center;">Auswahl der Gruppen</h4>
                    <draggable class="list-group" :list="gruppeFeld" group="gruppen" ghost-class="ghost" @start="drag=true" @end="drag=false">
                        <div class="list-group-item" v-for="gruppe in gruppeFeld" :key="gruppe.id">
                            {{gruppe.name}}
                        </div>
                    </draggable>
                </div>
                <div id="dokumentFeld" class="col alert alert-success feld">
                    <h4 style="text-align:center;">Gruppen des Dokuments</h4>
                    <draggable class="list-group" :list="dokument.gruppenDokument" group="gruppen" ghost-class="ghost" @start="drag=true" @end="drag=false">
                        <div class="list-group-item" v-for="gruppe in dokument.gruppenDokument" :key="gruppe.id">
                            {{gruppe.name}}
                        </div>
                    </draggable> 
                </div>
                <div id="deleteFeld" class="col alert alert-warning feld">
                    <h4 style="text-align:center;">Aus Dokument entfernen</h4>
                    <draggable class="list-group" :list="deleteFeld" group="gruppen" ghost-class="ghost" @start="drag=true" @end="drag=false">
                        <div class="list-group-item" v-for="(gruppe, index) in deleteFeld" :key="index">
                            {{gruppe.name}}
                        </div>
                    </draggable>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" :disabled="saving" class="btn btn-primary">Änderungen speichern</button>
                <button type="button" class="btn btn-success" @click.prevent="showPdf(dokument.id)">PDF anzeigen</button>
                <button type="button" class="btn btn-danger" @click.prevent="checkDelete(dokument.id)" :disabled="saving">Dokumentzuordnung löschen</button>
            </div>
        </form>
    </div>
</div>
</template>

<script>
import apiG from '../../api/gruppe';
import apiD from '../../api/dokument';
import draggable from 'vuedraggable';
import pdf from '../../pdfGenerate.js';

const getGruppen = (callback) => {
    const params =  { gruppe: 1};
    apiG.all(params)
        .then(response => {
            callback(null, response.data);})
        .catch(error => {
            callback(error, error.response.data);
    });
};

const formatDeckblatt = (doc, baustein) => {
    let text = '';
    text = doc.fontSize(25).text(baustein[1], {
        align: 'justify',
        indent: 50
    });
    text += doc.addPage();
    text += doc.fontSize(40).text(baustein[1], 100, 80);
    return text;
};

const formatHauptkapitel = (doc, baustein) => {
    let text = '';
};

const formatOberkapitel = (doc, baustein) => {
    let text = '';
};

const formatUnterkapitel = (doc, baustein) => {
    let text = '';
};

const createPdf = (bausteine) => {
    let text = '';
    const doc = new PDFDocument();
    var stream = doc.pipe(blobStream());

    bausteine.forEach((baustein) => {
        switch(baustein[0]){
           case "deckblatt":
               text += formatDeckblatt(doc, baustein);
               break;
            // case "hauptkapitel":
            //     text += formatHauptkapitel(baustein);
            //     break;
            // case "oberkapitel":
            //     text += formatOberkapitel(baustein);
            //     break;
            // case "unterkapitel":
            //     text += formatUnterkapitel(baustein);
            //     break;
            // default:
            //     text += formatDefault(baustein);
        }
    });

    // // and some justified text wrapped into columns
    // doc.text(dos, 100, 300).font('Times-Roman', 13).moveDown()
    // .text(dos, {
    //     width: 412,
    //     align: 'justify',
    //     indent: 30,
    //     columns: 2,
    //     height: 300,
    //     ellipsis: true
    // });

    doc.end();
    
    stream.on('finish', function() {
        $('#pdfModal').modal({backdrop: 'static'});
        document.getElementById('document').src = stream.toBlobURL('application/pdf');
    });
};

export default {
    components: {
        draggable
    },

    data(){
        return {
            bausteine: null,
            dokument: {
                name: '',
                gruppenDokument: [],
            },
            gruppeFeld: [],
            deleteFeld: [],
            message: null,
            error: null,
            loaded: false,
            saving: false
        }
    },

    beforeRouteEnter(to, from, next) {
        getGruppen((error, data) => {
            next(vm => vm.setData(error, data));
        });
    },

    created(){
        apiD.find(this.$route.params.id)
            .then((response) => {
                this.dokument = response.data.data;
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
        showPdf(id){
            apiD.pdf(id)
                .then((response) => {
                    this.bausteine = response.data.data.flat();
                    
                    document.getElementById('document').src = pdf.create(this.bausteine);
                    $('#pdfModal').modal({backdrop: 'static'});
                    // createPdf(this.bausteine);
                })
                .catch((error) => {
                    this.error = error.response.data;
                });
        },
        setData(error, data) {
            if (error) {
                this.error = null;
                this.error = error;
                this.loaded = true;
            } else {
                this.error = null;
                this.gruppeFeld= data.data;
                this.loaded = true;
            }
        },

        onSubmit(){
            if(this.dokument.gruppenDokument.length < 1){
                this.message = "Bitte mindestens eine Gruppe auswählen.";
                setTimeout(() => this.message = null, 1000);
            }else{
                this.saving = true;
                this.dokument.gruppenDokument = _.uniqBy(this.dokument.gruppenDokument, 'id');
                apiD.update(this.dokument.id, this.dokument)
                    .then((response) => {
                        this.message = 'Änderungen werden gespeichert!';
                        setTimeout(() => this.message = null, 1000);
                        this.dokument = response.data.data;
                    })
                    .catch((error) => {
                        this.error = error.response.data
                    })
                    .finally(() => {
                        setTimeout(() => this.saving = false, 1000);
                        setTimeout(() => this.$router.go(0), 1500);
                    });
            }
        },

        checkDelete(id){
            var auswahl = confirm('Soll das Dokument gelöscht werden?');
            if(auswahl) {
                this.deleteDokument(id);
            }
        },

        deleteDokument(id){
            this.message = null;
            this.saving = true;
            apiD.delete(id)
                .then((response) => {
                    this.message = "Dokument wird entfernt.";
                    setTimeout(() => this.message = null, 1000);
                })
                .catch((error) => {
                    this.error = error.response.data;
                })
                .finally(() => {
                    setTimeout(() => this.saving = false, 1000);
                    setTimeout(() => this.$router.push({name: 'AlleDokumente'}), 1500);
                });
        },
        
        reloadComponent(){
            window.location.reload();
        },
    }
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

#document {
    width: 100%;
    height: 100%;
}

</style>