//$ ceci est du jquery


$( document ).ready(function() {

   if ($('.info').data('player') != $('.info').data('turn')){
        setTimeout(function(){
        window.location.reload(1);
        }, 500);
    }



    var step = 0;
    var piece, startCoordinates, targetCoordinates;

    $('td').click(function(){

	if(step){
            targetCoordinates = $(this).attr("data-id").split(";");//chopper coordonnées d'arrivée
            piece.children().appendTo(this);


            $.post(
                window.location,
                    {   "targetRow" : targetCoordinates[0],
                        "targetColumn" : targetCoordinates[1],
                        "startRow" : startCoordinates[0],
                        "startColumn" : startCoordinates[1]
                    },
                    function(){
                        window.location.reload(1);
                    }
            );
	}
    if(!step){
        startCoordinates = $(this).attr("data-id").split(";");//chopper coordonnées de départ
        piece = $(this);
        if(piece.children().data('color') == $('.info').data('player') && $('.info').data('player') == $('.info').data('turn')){
            step = !step;
        }
        else if ($('.info').data('player') != $('.info').data('turn')){
            alert("Wait for your turn!");
        }
        else{
            alert("Wrong selection, try again!");
        }
    }
    });

});
