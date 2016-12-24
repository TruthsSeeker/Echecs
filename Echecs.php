<?php

    include "pieceChildClasses.php";
    $bw = 0;
    function Save($pieces, $db){
        foreach ($pieces as $piece) {
            $x = $piece->coordinates['column'];
            $y = $piece->coordinates['row'];
            //@TODO Pas répéter les query
            $insert=   "INSERT INTO piece (alive, color, x, y, type)
                        VALUES ('$piece->alive', '$piece->color', '$x', '$y', '$piece->type' )";
            $db->exec($insert);
        }
    }

    try {
        $db= new PDO('mysql:host=localhost;dbname=chess', 'root', '');
    } catch (Exception $db) {
        echo "Database Connection error";
    }

    function setUp(){
        return array(
        new bishop('W', 'Bishop', array('row' => 7, 'column' => 2)),
        new bishop('W', 'Bishop', array('row' => 7, 'column' => 5)),
        new bishop('B', 'Bishop', array('row' => 0, 'column' => 2)),
        new bishop('B', 'Bishop', array('row' => 0, 'column' => 5)),
        new rook('W', 'Rook',array('row' => 7, 'column' => 0)),
        new rook('W', 'Rook',array('row' => 7, 'column' => 7)),
        new rook('B', 'Rook',array('row' => 0, 'column' => 0)),
        new rook('B', 'Rook',array('row' => 0, 'column' => 7)),
        new king('W', 'King',array('row' => 7, 'column' => 4)),
        new king('B', 'King',array('row' => 0, 'column' => 4)),
        new queen('W', 'Queen',array('row' => 7, 'column' => 3)),
        new queen('B', 'Queen',array('row' => 0, 'column' => 3)),
        new knight('W', 'Knight', array('row' => 7, 'column' => 1)),
        new knight('W', 'Knight', array('row' => 7, 'column' => 6)),
        new knight('B', 'Knight', array('row' => 0, 'column' => 1)),
        new knight('B', 'Knight', array('row' => 0, 'column' => 6)),
    	new pawn('W', 'Pawn', array('row' => 6, 'column' => 0)),
        new pawn('W', 'Pawn', array('row' => 6, 'column' => 1)),
        new pawn('W', 'Pawn', array('row' => 6, 'column' => 2)),
        new pawn('W', 'Pawn', array('row' => 6, 'column' => 3)),
        new pawn('W', 'Pawn', array('row' => 6, 'column' => 4)),
        new pawn('W', 'Pawn', array('row' => 6, 'column' => 5)),
        new pawn('W', 'Pawn', array('row' => 6, 'column' => 6)),
        new pawn('W', 'Pawn', array('row' => 6, 'column' => 7)),
        new pawn('B', 'Pawn', array('row' => 1, 'column' => 0)),
        new pawn('B', 'Pawn', array('row' => 1, 'column' => 1)),
        new pawn('B', 'Pawn', array('row' => 1, 'column' => 2)),
        new pawn('B', 'Pawn', array('row' => 1, 'column' => 3)),
        new pawn('B', 'Pawn', array('row' => 1, 'column' => 4)),
        new pawn('B', 'Pawn', array('row' => 1, 'column' => 5)),
        new pawn('B', 'Pawn', array('row' => 1, 'column' => 6)),
        new pawn('B', 'Pawn', array('row' => 1, 'column' => 7))
        );
    }
    $GameBoard = array_fill(0, 8, array_fill(0, 8, 0));
    $pieces = setUp();
    $GameBoard[6][0]->move(array('row' => 5, 'column' => 0));
    if( !empty($_POST))
	{
		global $GameBoard;
		$startRow = (int)$_POST['startRow'];
		$startColumn = (int)$_POST['startColumn'];
		$targetRow = (int)$_POST['targetRow'];
		$targetColumn = (int)$_POST['targetColumn'];

		if (gettype($GameBoard[$startRow][$startColumn]) == 'object'){
			$GameBoard[$startRow][$startColumn]->move(array('row' => $targetRow, 'column' => $targetColumn));
		}
		else
		{echo(json_encode(array('error'=>'Wadya do!!')));}
	}
?>
<?php if(empty($_POST)):?>
<html>


    <head>
        <link rel="stylesheet" type="text/css" href="theme.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="chess.js"></script>
    </head>

    <body>
        <table>
            <tr>
                <td class='legend'></td>
                <td class='legend'>A</td>
                <td class='legend'>B</td>
                <td class='legend'>C</td>
                <td class='legend'>D</td>
                <td class='legend'>E</td>
                <td class='legend'>F</td>
                <td class='legend'>G</td>
                <td class='legend'>H</td>

            <?php foreach ($GameBoard as $key => $row): ?>
                <tr>
                    <td class="legend"><?php echo 8-$key; ?></td>
                    <?php if ($key%2==0){
                        $BWcursor=0;
                    }
                    else{
                        $BWcursor=1;
                    }?>
                    <?php foreach ($row as $key2 => $column): ?>
                        <?php if(!$BWcursor): ?>
                            <td class= "blanc" data-id = "<?php echo $key.';'.$key2; ?>">
                                <?php $BWcursor=1; ?>
                                <?php if ($GameBoard[$key][$key2] !== 0): ?>
                                <img src="<?php echo 'img/'.$GameBoard[$key][$key2]->color.$GameBoard[$key][$key2]->type;?>.png">
                                <?php endif; ?>
                            </td>
                        <?php else: ?>
                            <td class= "noir" data-id = "<?php echo $key.';'.$key2; ?>">
                                <?php $BWcursor=0;?>
                                <?php if ($GameBoard[$key][$key2] !== 0): ?>
                                <img src="<?php echo 'img/'.$GameBoard[$key][$key2]->color.$GameBoard[$key][$key2]->type;?>.png">
                                <?php endif; ?>
                            </td>
                        <?php endif;?>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>


    </body>
</html>
<?php endif;?>
