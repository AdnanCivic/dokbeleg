$(document).ready(function(event){ 
    $('#registration_form').submit(function(event){
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
                url: '/dokumentations',
                type: 'POST',
                data: {
                    bausteine: bausteinids
                },
                success: function(response){
                    console.log(response);
         //           var trHTML = '';
                    
        //             $.each(response, function(i, baustein){
        //                 var anzahl = baustein.marker;
        //                 var j;

        //                 trHTML += '<fieldset><legend>' + baustein.name + ':</legend>';
                        
        //                 for(j = 0; j < anzahl; j++){
        //                     trHTML += '<div class="ajaxRow"><label for="' + j + '_' + baustein.nummer + '">' + baustein.markerInhaltArray[j] + 
        //                     '</label><input id="' + j + '_' + baustein.nummer + '" style="width:100%" name="' + baustein.id + '_' + baustein.nummer + '[]" type="textfield"></div><br>';
        //                 }

        //                 trHTML += '<input type="button" name="previous" class="previous btn btn-secondary" value="Zurück"/>';
        //                 trHTML += '<input type="button" name="next" class="next btn btn-info" value="Weiter" />';
        //                 trHTML += '</fieldset>';
        //             });
        //             $('#modal-body').empty();
        //             $('#modal-body').append(trHTML);
        //             $('#formModal').modal('show');
        //             fortschrittanzeige();
                    
                 }
        //         done: function(xhr, status, error){
        //             var errorMessage = xhr.status + ': ' + xhr.statusText;
        //             alert('Fehler - ' + errorMessage + '\n' + 'Versuchen Sie es später erneut.');
        //         }
            });
        // }else{
        //     alert("Keine Bausteine ausgewählt!");
        }
    });
});