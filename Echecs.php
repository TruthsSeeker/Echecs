<?php

    include "pieceChildClasses.php";
    include "GameBoard.php";
    $bw = 0;

    try {
        $db= new PDO('mysql:host=localhost;dbname=chess', 'root', '');
    } catch (Exception $db) {
        echo "Database Connection error";
    }

    $GameBoard = new GameBoard();
    $GameBoard->setUpFromLoad(5);

    if( !empty($_POST))
	{

		global $GameBoard;
		$startRow = (int)$_POST['startRow'];
		$startColumn = (int)$_POST['startColumn'];
		$targetRow = (int)$_POST['targetRow'];
		$targetColumn = (int)$_POST['targetColumn'];

		if (gettype($GameBoard->Board[$startRow][$startColumn]) == 'object'){
			$GameBoard->Board[$startRow][$startColumn]->move(array('ligne' => $targetRow, 'colonne' => $targetColumn));
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

            <?php foreach ($GameBoard->Board as $key => $ligne): ?>
                <tr>
                    <td class="legend"><?php echo 8-$key; ?></td>
                    <?php if ($key%2==0){
                        $BWcursor=0;
                    }
                    else{
                        $BWcursor=1;
                    }?>
                    <?php foreach ($ligne as $key2 => $colonne): ?>
                        <?php if(!$BWcursor): ?>
                            <td class= "blanc" data-id = "<?php echo $key.';'.$key2; ?>">
                                <?php $BWcursor=1; ?>
                                <?php if ($GameBoard->Board[$key][$key2] !== 0): ?>
                                <img src="<?php echo 'img/'.$GameBoard->Board[$key][$key2]->color.$GameBoard->Board[$key][$key2]->type;?>.png">
                                <?php endif; ?>
                            </td>
                        <?php else: ?>
                            <td class= "noir" data-id = "<?php echo $key.';'.$key2; ?>">
                                <?php $BWcursor=0;?>
                                <?php if ($GameBoard->Board[$key][$key2] !== 0): ?>
                                <img src="<?php echo 'img/'.$GameBoard->Board[$key][$key2]->color.$GameBoard->Board[$key][$key2]->type;?>.png">
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
