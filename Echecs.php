<?php
    include "pieceChildClasses.php";
    include "GameBoard.php";
    $turn = 0;

    try {
        $db= new PDO('mysql:host=localhost;dbname=chess', 'root', '');
    } catch (Exception $db) {
        echo "Database Connection error";
    }

    if (!empty($_GET['new'])){
        $GameBoard = new GameBoard();
        $GameBoard->setUpFromLoad();
        $rand = (rand(0,1)? "W" : "B");
        error_reporting(E_ALL);
        header("Location: Echecs.php?gameboard=".$GameBoard->boardID."&player=".$rand);
        die; //TODO Find a way to change the url and reload the page
    }
    else{
    $GameBoard = new GameBoard($_GET['gameboard']);
    $GameBoard->setUpFromLoad($_GET['gameboard']);
    }

    $turnQuery = "SELECT p.id, p.gameboard, p.color, m.id, m.piece_id
                  FROM piece AS p, moves AS m 
                  WHERE p.id = m.piece_id AND 
                  p.gameboard = '$GameBoard->boardID'
                  ORDER BY m.id DESC;";
    $lastTurn = $db->query($turnQuery)->fetch()['color'];

    if ($lastTurn == 'W'){
        $turn = 'B';
    }
    else{
        $turn = 'W';
    }


    if( !empty($_POST['targetRow']))
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
<DOCTYPE HTML>
<html>


    <head>
        <link rel="stylesheet" type="text/css" href="theme.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="chess.js"></script>
    </head>

    <body>
    <div hidden="hidden" data-turn="<?php echo $turn?>" data-player="<?php echo $_GET['player']?>" data-gameboard="<?php echo $_GET['gameboard']?>" class="info"></div>
        <div class="dedW">
            <table>

            <?php foreach ($GameBoard->dedW as $piece):?>
                <tr>
                    <td>
                        <img src="<?php echo 'img/'.$piece;?>.png">
                    </td>
                </tr>
                <?php endforeach;?>
            </table>
        </div>

        <div class="boardContainer">
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
                                <img src="<?php echo 'img/'.$GameBoard->Board[$key][$key2]->color.$GameBoard->Board[$key][$key2]->type;?>.png" data-color="<?php echo $GameBoard->Board[$key][$key2]->color?>">
                                <?php endif; ?>
                            </td>
                        <?php else: ?>
                            <td class= "noir" data-id = "<?php echo $key.';'.$key2; ?>">
                                <?php $BWcursor=0;?>
                                <?php if ($GameBoard->Board[$key][$key2] !== 0): ?>
                                <img src="<?php echo 'img/'.$GameBoard->Board[$key][$key2]->color.$GameBoard->Board[$key][$key2]->type;?>.png" data-color="<?php echo $GameBoard->Board[$key][$key2]->color?>">
                                <?php endif; ?>
                            </td>
                        <?php endif;?>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
        </div>

        <div class="dedB">
            <table>

                <?php foreach ($GameBoard->dedB as $piece):?>
                    <tr>
                        <td>
                            <img src="<?php echo 'img/'.$piece;?>.png">
                        </td>
                    </tr>
                <?php endforeach;?>
            </table>
        </div>

        <div class="form">
        </div>

    </body>
</html>
<?php endif;?>
</DOCTYPE>