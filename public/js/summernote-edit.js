$(document).ready(function(){
    $('#summernote').summernote({
        height: 400,
        toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['undo'],
        ],
        callbacks: {
            onChange: function(){
                var newHTML = $('#summernote').summernote('code');
                $('#newHTML').val(newHTML);
            }
        }
    });
});