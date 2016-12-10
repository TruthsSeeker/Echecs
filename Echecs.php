<!-- Classe pour ranger tout ce que je fais avec GameBoard? -->
<html>


    <head>
        <link rel="stylesheet" type="text/css" href="theme.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="chess.js"></script>
    </head>

    <body>

        <?php

        /**
         *
         */
        abstract class piece
        {

            public $color = "";

            public $coordinates = array();

            public $type = "";

            abstract function legalMoves();

            function move($destination)
            {
                global $GameBoard;
                $moveBuffer = $this->legalMoves();
                foreach ($moveBuffer as $key => $value) {
                    if ($moveBuffer[$key] == $destination) {
                        if ($GameBoard[$destination['row']][$destination['column']] !== 0)
                        {
                            $GameBoard[$destination['row']][$destination['column']] = 0;
                        }
                        $GameBoard[$this->coordinates['row']][$this->coordinates['column']] = 0;
                        $this->coordinates = $destination;
                        $GameBoard[$destination['row']][$destination['column']] = $this;

                    }
                }
            }

            function __construct($color, $type, $coordinates)
            {
                $this->color = $color;
                foreach ($coordinates as $key => $value) {
                    $this->coordinates[$key]= $value;
                }
                $this->type = $type;
                global $GameBoard;
                $GameBoard[$this->coordinates['row']][$this->coordinates['column']] = $this;
            }


        }

        class knight extends piece
        {

            function legalMoves()
            {
                global $GameBoard;
                $legalMoves = array();
                foreach ($GameBoard as $Ykey => $row) {
                    foreach ($row as $Xkey => $column) {
                        $distance = pow($Ykey-$this->coordinates['row'], 2) + pow($Xkey-$this->coordinates['column'], 2);
                        if ($distance == 5) {//add a condition that the space must not be occupied by a friendly piece

                            $legalMoves[]= array('column' => $Xkey , 'row' => $Ykey );
                        }
                    }
                }

                foreach ($legalMoves as $key => $value) {
                    if (gettype($GameBoard[$legalMoves[$key]['row']][$legalMoves[$key]['column']]) == 'object'
                    && $GameBoard[$legalMoves[$key]['row']][$legalMoves[$key]['column']]->color == $this->color) {
                        unset($legalMoves[$key]);
                    }
                }

                return $legalMoves;
            }

            function __construct($color, $type, $coordinates)
            {
                parent::__construct($color, $type, $coordinates);
            }

        }

        class bishop extends piece
        {

            function legalMoves()
            {
                global $GameBoard;
                $legalMoves = array();
                foreach ($GameBoard as $Ykey => $row) {
                    foreach ($row as $Xkey => $column) {
                        if ($Xkey - $this->coordinates['column'] == $Ykey - $this->coordinates['row']) {//needs to stop before friendly pieces and at ennemy pieces
                            $legalMoves[] = array('column' => $Xkey , 'row' => $Ykey );
                        }
                    }
                }
                return $legalMoves;
            }

            function __construct($color, $type, $coordinates)
            {
                parent::__construct($color, $type, $coordinates);
            }

        }

        class queen extends piece
        {

            function legalMoves()
            {
                global $GameBoard;
                $legalMoves = array();
                foreach ($GameBoard as $Ykey => $row) {
                    foreach ($row as $Xkey => $column) {
                        if ($Xkey - $this->coordinates['column'] == $Ykey - $this->coordinates['row']
                        || $Xkey == $this->coordinates['column']
                        || $Ykey == $this->coordinates['row']) {//needs to stop before friendly pieces and at ennemy pieces
                            $legalMoves[] = array('column' => $Xkey , 'row' => $Ykey );
                        }
                    }
                }
                return $legalMoves;
            }

            function __construct($color, $type, $coordinates)
            {
                parent::__construct($color, $type, $coordinates);
            }


        }

        class king extends piece
        {

            function legalMoves()
            {
                global $GameBoard;
                $legalMoves = array();
                foreach ($GameBoard as $Ykey => $row) {
                    foreach ($row as $Xkey => $column) {
                        $distance = pow($Ykey-$this->coordinates['row'], 2) + pow($Xkey-$this->coordinates['column'], 2);
                        if ($distance == 1 || $distance == 2) {//add a condition that the space must not be occupied by a friendly piece

                            $legalMoves[]= array('column' => $Xkey , 'row' => $Ykey );
                        }
                    }
                }

                return $legalMoves;
            }

            function __construct($color, $type, $coordinates)
            {
                parent::__construct($color, $type, $coordinates);
            }

        }

        class rook extends piece
        {
            function legalMoves()
            {
                global $GameBoard;
                $legalMoves = array();
                foreach ($GameBoard as $Ykey => $row) {
                    foreach ($row as $Xkey => $column) {
                        if ($Xkey == $this->coordinates['column'] || $Ykey == $this->coordinates['row']){//needs to stop before friendly pieces and at ennemy pieces
                            $legalMoves[] = array('column' => $Xkey , 'row' => $Ykey );
                        }
                    }
                }
                return $legalMoves;
            }

            function __construct($color, $type, $coordinates)
            {
                parent::__construct($color, $type, $coordinates);
            }

        }


        class pawn extends piece
        {


            function enPassant()
            {
                global $GameBoard;
                $legalMoves= array();
                if ($this->color == 'W')
                {
                    if ($this->coordinates['row'] == 4
                    && $GameBoard[$this->coordinates['row']][$this->coordinates['column'] - 1][0] == 'BPawn'
                    && $GameBoard[$this->coordinates['row'] - 1][$this->coordinates['column'] - 1][0] === 0)
                    {
                        $legalMoves[] = array('column' => $this->coordinates['column'] - 1, 'row' => $this->coordinates['row'] - 1);
                    }

                    if ($this->coordinates['row'] == 4
                    && $GameBoard[$this->coordinates['row']][$this->coordinates['column'] + 1][0] == 'BPawn'
                    && $GameBoard[$this->coordinates['row'] - 1][$this->coordinates['column'] + 1][0] === 0)
                    {
                        $legalMoves[] = array('column' => $this->coordinates['column'] + 1, 'row' => $this->coordinates['row'] - 1);
                    }
                }
                else
                {
                    if ($this->coordinates['row'] == 3
                    && $GameBoard[$this->coordinates['row']][$this->coordinates['column'] - 1][0] == 'WPawn'
                    && $GameBoard[$this->coordinates['row'] + 1][$this->coordinates['column'] - 1][0] === 0)
                    {
                        $legalMoves[] = array('column' => $this->coordinates['column'] - 1, 'row' => $this->coordinates['row'] + 1);
                    }

                    if ($this->coordinates['row'] == 3
                    && $GameBoard[$this->coordinates['row']][$this->coordinates['column'] + 1][0] !== 'WPawn'
                    && $GameBoard[$this->coordinates['row'] + 1][$this->coordinates['column'] + 1] === 0)
                    {
                        $legalMoves[] = array('column' => $this->coordinates['column'] + 1, 'row' => $this->coordinates['row'] + 1);
                    }
                }
                return $legalMoves;
            }

            function legalMoves()
            {
                global $GameBoard;
                $legalMoves = array();
                $legalMoves[] = $this->enPassant();
                if ($this->startPosition == 'B')
                {
                    if ($GameBoard[$this->coordinates['row'] + 1][$this->coordinates['column']] === 0)
                    {
                        $legalMoves[] = array('column' => $this->coordinates['column'], 'row' => $this->coordinates['row'] + 1);
                    }
                    if ($GameBoard[$this->coordinates['row'] + 1][$this->coordinates['column']] === 0
                    && $GameBoard[$this->coordinates['row'] + 2][$this->coordinates['column']] === 0
                    && $this->coordinates['row'] == 2)
                    {
                        $legalMoves[] = array('column' => $this->coordinates['column'], 'row' => $this->coordinates['row'] + 2);
                    }

                }
                else
                {
                    if ($GameBoard[$this->coordinates['row'] - 1][$this->coordinates['column']] === 0)
                    {
                        $legalMoves[] = array('column' => $this->coordinates['column'], 'row' => $this->coordinates['row'] - 1);
                    }
                    if ($GameBoard[$this->coordinates['row'] - 1][$this->coordinates['column']] === 0
                    && $GameBoard[$this->coordinates['row'] - 2][$this->coordinates['column']] === 0
                    && $this->coordinates['row'] == 6)
                    {
                        $legalMoves[] = array('column' => $this->coordinates['column'], 'row' => $this->coordinates['row'] - 2);
                    }
                }
                return $legalMoves;
            }

            function __construct($color, $type, $coordinates)
            {
                parent::__construct($color, $type, $coordinates);
            }

        }


        function Advance(&$GameBoard, $Y, $X){
            if ($Y+1>7){
                echo "Illegal Move";
            }
            else {
                $GameBoard[$Y+1][$X]=$GameBoard[$Y][$X];
                $GameBoard[$Y][$X]=0;
            }
        }

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


            $GameBoard= array_fill(0, 8, array_fill(0, 8, 0));
            $testRook= new rook('W', 'Rook', array('row' => 5, 'column' => 5));
            $testKnight= new knight('W', 'Knight', array('row' => 6, 'column' => 7));
            var_dump($testKnight->legalMoves());
            $testKnight->move(array('row' => 4 , 'column' => 6));

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
                            <td class= "blanc">
                                <?php $BWcursor=1; ?>
                                <?php if ($GameBoard[$key][$key2] !== 0): ?>
                                <img src="<?php echo $GameBoard[$key][$key2]->color.$GameBoard[$key][$key2]->type;?>.png">
                                <?php endif; ?>
                            </td>
                        <?php else: ?>
                            <td class= "noir">
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
