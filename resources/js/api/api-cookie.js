$(document).ready(function(event){ 
    $("#login-form").on('submit', function(e){
        e.preventDefault();
        $(this).off();
        axios.get('/sanctum/csrf-cookie')
            .finally( () => { $("form").submit(); } );
    });
});