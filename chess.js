//$ ceci est du jquery
var piece;

$( document ).ready(function() {
//setTimeout(function(){
//   window.location.reload(1);
//}, 500);

    function konami(){
        $('td').mouseover(
            function(e){
                $( this ).css("background-color", "red");
            }
        )

    }

	var step = 0;


    $('td').click(function(){
        //konami();
		step = !step;
		if(step){
			//chopper coordonnées de départ
			piece = $(this);
		}
		if(!step){
			//chopper coordonnées d'arrivée
			piece.children().appendTo(this);
			$.post(
				"Echecs.php",
				{ "targetRow" : "4", "targetColumn" : "6", "startRow" : "6", "startColumn" : "7"},
				function( data ){
					console.log(data);
				}
			)
		}
    })

});
