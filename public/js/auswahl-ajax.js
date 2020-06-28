$(document).ready(function(event){ 
    $('#selectBausteine').submit(function(event){
        event.preventDefault();
        var bausteinids = getBausteinIds();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/getBausteine',
            type: 'POST',
            data: {
                bausteine: bausteinids
            },
            success: function(response){
                var trHTML = '';
                
                $.each(response, function(i, baustein){
                    
                    // trHTML += '<tr class="ajaxRow"><td>' + baustein.name + '</td><td>' + baustein.id + '</td><td><input name="selectbausteinid" type="checkbox" value="' + baustein.id + '"></td></tr>';
                });
                
            },
            done: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText;
                alert('Fehler - ' + errorMessage + '\n' + 'Versuchen Sie es später erneut.');
            }
        });
    });
});

function getBausteinIds(){
    var boxes = document.querySelectorAll('#rechteListe input[name=bausteinid]');
    var anzahl = boxes.length;
    var idArray = [];

    for(var i = 0; i < anzahl; i++){
        idArray.push(boxes[i].value);
    }
    
    return idArray;
}