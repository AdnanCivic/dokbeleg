<template>
    <div>
        <div id="summernote"></div>
        <!-- <button class="btn btn-primary" type="button" @click="bausteinSpeichern">Textbaustein speichern</button> -->
    </div>
</template>

<script>
    export default {
        props: {
            editorContent: {
                type: String,
                required: false
            }
        },
        data(){
            return {
                value: '',
            }
        },

        created(){
            this.value = this.editorContent;
            console.log(value);
        },

        mounted(){
            this.loadSummernote();
            // this.loadContent();
        },

        methods: {
            loadSummernote() {
                $(document).ready(function() {
                    $('#summernote').summernote({
                        focus: true,
                        height: 300,
                        toolbar: [
                            ['style', ['bold', 'italic', 'underline', 'clear']],
                            ['font', ['strikethrough']],
                            ['fontsize', ['fontsize', '16']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['height', ['height']],
                            ['undo'],
                            ['codeview'],
                        ]
                    });
                });
                
            },

            loadContent(){
                // console.log(this.editorContent);
                // $('#summernote').summernote('code', this.econtent);
                // $('#summernote').summernote('code', this.content);
            },

            bausteinSpeichern: function(){
                var formatStr = $('#summernote').summernote('code');
                console.log(formatStr);
                // axios in db speichern
                this.$emit('bausteinsaved');
                
            },
        }
    }
</script>