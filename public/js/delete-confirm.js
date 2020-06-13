$(".entfernen").on("click", function(e){
    var res = confirm("Soll der Baustein wirklich gelöscht werden?");
    if(res == false){
        e.preventDefault();
    }
});