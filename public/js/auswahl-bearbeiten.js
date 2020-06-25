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

$("#rechteTabelle tbody").on('dblclick', function(){
    this.lastChild.remove();
});