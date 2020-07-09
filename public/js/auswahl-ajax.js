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
                    var anzahl = baustein.marker;
                    var j;

                    trHTML += '<fieldset><legend>' + baustein.name + ':</legend>';
                    

                    for(j = 0; j < anzahl; j++){
                        trHTML += '<div class="ajaxRow"><label for="' + j + '_' + baustein.name + '">' + baustein.markerInhaltArray[j] + 
                        '</label><input id="' + j + '_' + baustein.name + '" style="width:100%" name="' + baustein.id + '_' + baustein.name + '[]" type="textfield"></div><br>';
                    }

                    trHTML += '</fieldset';
                });
                
                $('#modal-body').append(trHTML);
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