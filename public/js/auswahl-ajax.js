$(document).ready(function(event){ 
    $('#selectBausteine').submit(function(event){
        event.preventDefault();
        var bausteinids = getBausteinIds();
        var anzahl = bausteinids.length;
        if(anzahl > 0){
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

                        trHTML += '<input type="button" name="previous" class="previous btn btn-secondary" value="Zurück"/>';
                        trHTML += '<input type="button" name="next" class="next btn btn-info" value="Weiter" />';
                        trHTML += '</fieldset>';
                    });
                    $('#modal-body').empty();
                    $('#modal-body').append(trHTML);
                    $('#formModal').modal('show');
                    fortschrittanzeige();
                    
                },
                done: function(xhr, status, error){
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    alert('Fehler - ' + errorMessage + '\n' + 'Versuchen Sie es später erneut.');
                }
            });
        }else{
            alert("Keine Bausteine ausgewählt!");
        }
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

function fortschrittanzeige(){
    var anzahlFS, jetztFS, nextFS, count = 1;
    anzahlFS = $("fieldset").length;

    $(".modal-body").on('click', '.next', function(){
        jetztFS = $(this).parent();
        nextFS = $(this).parent().next();
        nextFS.show();
        jetztFS.hide();
        setProgressBar(++count);
        
    });

    $(".modal-body").on('click', '.previous', function(){
        jetztFS = $(this).parent();
        nextFS = $(this).parent().prev();
        nextFS.show();
        jetztFS.hide();
        setProgressBar(--count);
    });

    setProgressBar(count);
    
    function setProgressBar(count){
        var prozent = parseFloat(100 / anzahlFS) * count;
        prozent = prozent.toFixed();
        $(".progress").css("width", "100%");
        $(".progress-bar").css("width", prozent + "%").html(prozent + "%");
        if(prozent == 100){
            $('#formSubmit').css('display', 'block');
        }else{
            $('#formSubmit').css('display', 'none');
        }
    }
}