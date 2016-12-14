//$ ceci est du jquery


$( document ).ready(function() {
//setTimeout(function(){
//   window.location.reload(1);
//}, 500);



	var step = 0;
    var piece, startCoordinates, targetCoordinates;

    $('td').click(function(){
        //konami();

		step = !step;
		if(step){
			startCoordinates = $(this).attr("data-id").split(";");//chopper coordonnées de départ
			piece = $(this);
            console.log(startCoordinates);
		}
		if(!step){
			targetCoordinates = $(this).attr("data-id").split(";");//chopper coordonnées d'arrivée
			piece.children().appendTo(this);

			$.post(
				"Echecs.php",
				{ "targetRow" : targetCoordinates[0] , "targetColumn" : targetCoordinates[1], "startRow" : startCoordinates[0], "startColumn" : startCoordinates[1]}
			)
		}
    })

});
