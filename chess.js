
$( document ).ready(function() {
    var step = 0;
    var piece, startCoordinates, targetCoordinates;
    var turn = 0;

    /*
     *I am reworking this function to reflect the changes made to isTurn.php and to clarify the logic.
     *Check turn will actually check whether the turn is the same.
     * */
    
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
                        currentTurn = data;
                        if (currentTurn == $('.info').data('player')){
                            window.location.reload();
                        }
                        else{
                            checkTurn();
                        }
                    }
                )};
        }, 2000)

    }
//I tried something by separating the logic of pieceMove() from the JQuery event function but something isn't
//working correctly. I suspect I'm doing something wrong regarding jQuery events or I need to pass parameters
    function pieceMove(td) {
        if (step) {
            targetCoordinates = td.attr("data-id").split(";");//chopper coordonnées d'arrivée
            piece.children().appendTo(td);


            $.post(
                window.location,
                {
                    "targetRow": targetCoordinates[0],
                    "targetColumn": targetCoordinates[1],
                    "startRow": startCoordinates[0],
                    "startColumn": startCoordinates[1]
                },
                function () {
                    window.location.reload(1);
                }
            );
        }
        if (!step) {
            startCoordinates = $(td).attr("data-id").split(";");//chopper coordonnées de départ
            piece = $(td);
            if (piece.children().data('color') == $('.info').data('player') && $('.info').data('player') == $('.info').data('turn')) {
                step = !step;
            }
            else if ($('.info').data('player') != $('.info').data('turn')) {
                alert("Wait for your turn!");
            }
            else {
                alert("Wrong selection, try again!");
            }
        }
    }

    if ($('.info').data('turn') != $('.info').data('player')){
    checkTurn();
    }

//This is the "event function". I was trying to see the different things happening for each event
//but there is something I'm doing wrong. I think it might be to do with the parameters I'm passing
//to pieceMove()
    $('td').click(function () {
        pieceMove($(this));
    });

});


