
$( document ).ready(function() {

    var turn = 0;

    function checkTurn(){
        setTimeout(function(){
            if(!turn){
                $.post(
                    "isTurn.php",
                    {
                        "gameboard" : $('.info').data('gameboard'),
                        "player" : $('.info').data('player')
                    },
                    function(data){
                        turn = data;
                        if (!turn){
                            checkTurn();
                        }
                        else{
                            window.location.reload();
                        }
                    }
                )};//TODO arretez de vous rafraichir (vous etes des animaux)
        }, 500)

    }

    checkTurn();
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


