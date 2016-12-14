<!-- Classe pour ranger tout ce que je fais avec GameBoard? -->
<html>


    <head>
        <link rel="stylesheet" type="text/css" href="theme.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="chess.js"></script>
    </head>

    <body>

        <?php

        include "var.php";

        function Save($GameBoard, $db){
            $buf= json_encode($GameBoard);
            $insert= "INSERT INTO board (save)
            VALUES ('$buf')";
            $db->exec($insert);
        }

        try {
            $db= new PDO('mysql:host=localhost;dbname=chess', 'root', '');
        } catch (Exception $db) {
            echo "Database Connection error";
        }


            $GameBoard = array_fill(0, 8, array_fill(0, 8, 0));
            $testBishop = new queen('W', 'Bishop', array('row' => 5, 'column' => 5));
            $testKnight = new knight('W', 'Knight', array('row' => 6, 'column' => 7));
			$testPawn = new pawn('B', 'Pawn', array('row' => 3, 'column' => 3));
            $testKnight->move(array('row' => 4 , 'column' => 6));
			var_dump($testBishop->Gameboard);
			echo "<br><br><br><br>v";
			var_dump($testBishop->legalMoves());

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
                            <td class= "blanc" data-id = "<?php echo $key; ?>.';'.<?php echo $key2; ?>">
                                <?php $BWcursor=1; ?>
                                <?php if ($GameBoard[$key][$key2] !== 0): ?>
                                <img src="<?php echo $GameBoard[$key][$key2]->color.$GameBoard[$key][$key2]->type;?>.png">
                                <?php endif; ?>
                            </td>
                        <?php else: ?>
                            <td class= "noir" data-id = "<?php echo $key; ?>.';'.<?php echo $key2; ?>">
                                <?php $BWcursor=0;?>
                                <?php if ($GameBoard[$key][$key2] !== 0): ?>
                                <img src="<?php echo $GameBoard[$key][$key2]->color.$GameBoard[$key][$key2]->type;?>.png">
                                <?php endif; ?>
                            </td>
                        <?php endif;?>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
        <br>
        <br>
		<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="movement">
			Point de Depart: <select name="startColumn" form="movement" required>
                                <option value=0>A</option>
                                <option value=1>B</option>
                                <option value=2>C</option>
                                <option value=3>D</option>
                                <option value=4>E</option>
                                <option value=5>F</option>
                                <option value=6>G</option>
                                <option value=7>H</option>
                            </select>

                            <select name="startRow" form="movement" required>
								<option value=7>1</option>
								<option value=6>2</option>
								<option value=5>3</option>
								<option value=4>4</option>
								<option value=3>5</option>
								<option value=2>6</option>
								<option value=1>7</option>
								<option value=0>8</option>
							</select>



			<br>
            Destination:    <select name="targetColumn" form="movement" required>
                                <option value=0>A</option>
                                <option value=1>B</option>
                                <option value=2>C</option>
                                <option value=3>D</option>
                                <option value=4>E</option>
                                <option value=5>F</option>
                                <option value=6>G</option>
                                <option value=7>H</option>
                            </select>

                            <select name="targetRow" form="movement" required>
								<option value=7>1</option>
								<option value=6>2</option>
								<option value=5>3</option>
								<option value=4>4</option>
								<option value=3>5</option>
								<option value=2>6</option>
								<option value=1>7</option>
								<option value=0>8</option>
							</select>


						<input type="submit">
            </form>
            <br>
            <br>

    </body>
</html>
<?php endif;?>
