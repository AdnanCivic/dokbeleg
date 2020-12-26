<template>
    <div>
        <div id="summernote"></div>
        <button class="btn btn-primary" type="button" @click="bausteinSpeichern">Textbaustein speichern</button>
        <button class="btn btn-secondary" type="button" @click="testFunction">Zweiter Button</button>
    </div>
    
</template>

<script>
export default {
    data(){
        return {
            summernote: '',
        }
    },

    mounted(){
        this.loadSummernote();
    },

    methods: {
        loadSummernote: function(){
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

        bausteinSpeichern: function(){
            var formatStr = $('#summernote').summernote('code');
            
            console.log(formatStr);
            // axios in db speichern
            this.$emit('bausteinsaved');
            
        },

        testFunction: function(){
            alert('Zwei');
        }
    }
}
</script>