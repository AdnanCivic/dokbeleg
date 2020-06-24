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
                if(response.hasOwnProperty('message')){
                    trHTML += '<tr class="ajaxRow"><td>' + response.message + '</td><tr>';
                }else{
                    $.each(response, function(i, baustein){
                    trHTML += '<tr class="ajaxRow"><td>' + baustein.name + '</td><td>' + baustein.id + '</td><td><input name="selectbausteinid" type="checkbox" value="' + baustein.id + '"></td></tr>';
                    });
                }
                $('#rechteListe').append(trHTML);  
            },
            done: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText;
                alert('Fehler - ' + errorMessage + '\n' + 'Versuchen Sie es später erneut.');
            }
        });
    });
});

function getBausteinIds(){
    var checkedBoxes = document.querySelectorAll('input[name=bausteinid]:checked');
    var anzahl = checkedBoxes.length;
    var idArray = [];

    for(var i = 0; i < anzahl; i++){
        idArray.push(checkedBoxes[i].value);
    }
    
    return idArray;
}

$("#rechteTabelle tbody").on('dblclick', function(){
    this.lastChild.remove();
});
