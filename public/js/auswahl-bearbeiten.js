$('#markierbutton').on('click', function(){
    $('#linkeListe input[type="checkbox"]' ).prop('checked', true);
});

$('#uncheckbutton').on('click', function(){
    $('#linkeListe input[type="checkbox"]:checked').prop('checked', false);
});

$("#transferbutton").on('click', function(){
    var checkedBoxes = $("#linkeListe").children().has('input[name=bausteinid]:checked');
    var anzahl = checkedBoxes.length;
    var selectedReihen = $("#rechteListe").children().has('input[name=bausteinid]');
    var anzahlRechts = selectedReihen.length;
    var i, j, k;

    if(anzahlRechts > 0){
        var idArray = [];
        for(i = 0; i < anzahlRechts; i++){
            var el = selectedReihen[i].childNodes[3].firstChild.getAttribute('value');
            idArray.push(el);
        }
        for(j = 0; j < anzahl; j++){
            var value = checkedBoxes[j].childNodes[3].firstChild.getAttribute('value');
            if(idArray.includes(value)){
                console.log("none");
            }else{
                var Noder = checkedBoxes[j].cloneNode(true);
                $("#rechteListe").append(Noder);
            }
        }   
    }else{
        for(k = 0; k < anzahl; k++){
            var Node = checkedBoxes[k].cloneNode(true);
            $("#rechteListe").append(Node);
        }
    } 
});

$('#alleEntfernenButton').on('click', function(){
    $('#rechteTabelle tbody tr').remove();
});

$('#unmarkierButton').on('click', function(){
    $('#rechteListe input[type="checkbox"]:checked').prop('checked', false);
});

$('#markierteEntfernenButton').on('click', function(){
    $('#rechteListe input[type="checkbox"]:checked').parent().parent().remove();
});

$('#obenButton').on('click', function(){
    var input = $('#rechteListe input[type="checkbox"]:checked').first();
    var reihe = input.parent().parent();
    reihe.insertBefore(reihe.prev());
});

$('#untenButton').on('click', function(){
    var input = $('#rechteListe input[type="checkbox"]:checked').first();
    var reihe = input.parent().parent();
    reihe.insertAfter(reihe.next());
});