<?php
abstract class piece
    {

        public $color = "";

        public $coordinates = array();

        public $type = "";

        public $Gameboard = array();

        public $alive = 1;

        public $id;

        abstract function legalMoves();

        public $trajectory = array ( 'up', 'down', 'left', 'right', 'upLeft', 'upRight', 'downLeft', 'downRight');

        public function __construct($GameBoard, $color, $ligne, $colonne, $alive, $id = NULL)
        {
            global $db;
            $this->coordinates = ['ligne' => $ligne, 'colonne' => $colonne];
            $this->color = $color;
            $this->alive = $alive;
            $GameBoard->Board[$this->coordinates['ligne']][$this->coordinates['colonne']] = $this;
            $this->Gameboard = &$GameBoard->Board;
            if ($id == NULL) {

                $insert=   "INSERT INTO piece (alive, color, type, gameboard, ligne, colonne)
                            VALUES ('$this->alive', '$this->color', '$this->type', '$GameBoard->boardID', '$ligne', '$colonne')";
                $db->exec($insert);
                $getID = "SELECT LAST_INSERT_ID()";
                $this->id = (int)$db->query($getID)->fetch()[0]; // ->query() returns an object ->fetch() returns a table [0] gets the value
            }
            else {
                $this->id = $id;
            }
        }


        function right(){
            $i = 1;
            $j = 1;
            $legalMoves = array();
            while ($i) {
                if ($this->coordinates['colonne'] + $j <= 7){
                    if (!$this->Gameboard[$this->coordinates['ligne']][$this->coordinates['colonne'] + $j]) {
                        $legalMoves[] = array('colonne' => $this->coordinates['colonne'] + $j , 'ligne' => $this->coordinates['ligne'] );
                    }
                    elseif (gettype($this->Gameboard[$this->coordinates['ligne']][$this->coordinates['colonne'] + $j]) == 'object'
                    && $this->Gameboard[$this->coordinates['ligne']][$this->coordinates['colonne'] + $j]->color != $this->color) {
                        $legalMoves[] = array('colonne' => $this->coordinates['colonne'] + $j , 'ligne' => $this->coordinates['ligne'] );
                        $i = 0;
                    }
                    elseif (gettype($this->Gameboard[$this->coordinates['ligne']][$this->coordinates['colonne'] + $j]) == 'object'
                    && $this->Gameboard[$this->coordinates['ligne']][$this->coordinates['colonne'] + $j]->color == $this->color) {
                        $i = 0;
                    }

                    $j++;
                }
                else{
                    $i = 0;
                }
            }
            return $legalMoves;
        }

        function left(){
            $i = 1;
            $j = 1;
            $legalMoves = array();
            while ($i) {
                if ($this->coordinates['colonne'] - $j >= 0 ){
                    if (!$this->Gameboard[$this->coordinates['ligne']][$this->coordinates['colonne'] - $j]) {
                        $legalMoves[] = array('colonne' => $this->coordinates['colonne'] - $j , 'ligne' => $this->coordinates['ligne'] );
                    }
                    elseif (gettype($this->Gameboard[$this->coordinates['ligne']][$this->coordinates['colonne'] - $j]) == 'object'
                    && $this->Gameboard[$this->coordinates['ligne']][$this->coordinates['colonne'] - $j]->color != $this->color) {
                        $legalMoves[] = array('colonne' => $this->coordinates['colonne'] - $j , 'ligne' => $this->coordinates['ligne'] );
                        $i=0;
                    }
                    elseif (gettype($this->Gameboard[$this->coordinates['ligne']][$this->coordinates['colonne'] - $j]) == 'object'
                    && $this->Gameboard[$this->coordinates['ligne']][$this->coordinates['colonne'] - $j]->color == $this->color) {
                        $i=0;
                    }
                    $j++;
                }
                else {
                    $i = 0;
                }
            }

            return $legalMoves;
        }

        function up(){
            $i = 1;
            $j = 1;
            $legalMoves = array();
            while ($i) {
                if ($this->coordinates['ligne'] - $j >= 0){
                    if (!$this->Gameboard[$this->coordinates['ligne'] - $j][$this->coordinates['colonne']]) {
                        $legalMoves[] = array('colonne' => $this->coordinates['colonne'], 'ligne' => $this->coordinates['ligne'] - $j );
                    }
                    elseif (gettype($this->Gameboard[$this->coordinates['ligne'] - $j][$this->coordinates['colonne']]) == 'object'
                    && $this->Gameboard[$this->coordinates['ligne'] - $j][$this->coordinates['colonne']]->color != $this->color) {
                        $legalMoves[] = array('colonne' => $this->coordinates['colonne'], 'ligne' => $this->coordinates['ligne'] - $j);
                        $i=0;
                    }
                    elseif (gettype($this->Gameboard[$this->coordinates['ligne'] - $j][$this->coordinates['colonne']]) == 'object'
                    && $this->Gameboard[$this->coordinates['ligne'] - $j][$this->coordinates['colonne']]->color == $this->color) {
                        $i=0;
                    }
                    $j++;
                }

                else {
                    $i = 0;
                }
            }

            return $legalMoves;
        }

        function down(){
            $i = 1;
            $j = 1;
            $legalMoves = array();
            while ($i) {
                if( $this->coordinates['ligne'] + $j <= 7){
                    if (!$this->Gameboard[$this->coordinates['ligne'] + $j][$this->coordinates['colonne']]) {
                        $legalMoves[] = array('colonne' => $this->coordinates['colonne'], 'ligne' => $this->coordinates['ligne'] + $j );
                    }
                    elseif (gettype($this->Gameboard[$this->coordinates['ligne'] + $j][$this->coordinates['colonne']]) == 'object'
                    && $this->Gameboard[$this->coordinates['ligne'] + $j][$this->coordinates['colonne']]->color != $this->color) {
                        $legalMoves[] = array('colonne' => $this->coordinates['colonne'], 'ligne' => $this->coordinates['ligne'] + $j);
                        $i=0;
                    }
                    elseif (gettype($this->Gameboard[$this->coordinates['ligne'] + $j][$this->coordinates['colonne']]) == 'object'
                    && $this->Gameboard[$this->coordinates['ligne'] + $j][$this->coordinates['colonne']]->color == $this->color) {
                        $i=0;
                    }

                    $j++;
                }

                else {
                    $i = 0;
                }

            }
            return $legalMoves;
        }

        function upRight(){
            $i = 1;
            $j = 1;
            $legalMoves = array();
            while ($i) {
                if($this->coordinates['ligne'] - $j >= 0 && $this->coordinates['colonne'] + $j <= 7){
                    if (!$this->Gameboard[$this->coordinates['ligne'] - $j][$this->coordinates['colonne'] + $j]) {
                        $legalMoves[] = array('colonne' => $this->coordinates['colonne'] + $j, 'ligne' => $this->coordinates['ligne'] - $j );
                    }

                    elseif (gettype($this->Gameboard[$this->coordinates['ligne'] - $j][$this->coordinates['colonne'] + $j]) == 'object'
                    && $this->Gameboard[$this->coordinates['ligne'] - $j][$this->coordinates['colonne'] + $j]->color != $this->color) {
                        $legalMoves[] = array('colonne' => $this->coordinates['colonne'] + $j, 'ligne' => $this->coordinates['ligne'] - $j);
                        $i=0;
                    }

                    elseif (gettype($this->Gameboard[$this->coordinates['ligne'] - $j][$this->coordinates['colonne'] + $j]) == 'object'
                    && $this->Gameboard[$this->coordinates['ligne'] - $j][$this->coordinates['colonne'] + $j]->color == $this->color) {
                        $i=0;
                    }

                    $j++;
                }

                else{
                    $i = 0;
                }
            }

            return $legalMoves;
        }

        function upLeft(){
            $i = 1;
            $j = 1;
            $legalMoves = array();
            while ($i) {
                if ($this->coordinates['ligne'] - $j >= 0 && $this->coordinates['colonne'] - $j >= 0){
                    if ($this->Gameboard[$this->coordinates['ligne'] - $j][$this->coordinates['colonne'] - $j] === 0) {
                        $legalMoves[] = array('colonne' => $this->coordinates['colonne'] - $j, 'ligne' => $this->coordinates['ligne'] - $j );
                    }
                    elseif (gettype($this->Gameboard[$this->coordinates['ligne'] - $j][$this->coordinates['colonne'] - $j]) == 'object'
                    && $this->Gameboard[$this->coordinates['ligne'] - $j][$this->coordinates['colonne'] - $j]->color != $this->color) {
                        $legalMoves[] = array('colonne' => $this->coordinates['colonne'] - $j, 'ligne' => $this->coordinates['ligne'] - $j);
                        $i=0;
                    }
                    elseif (gettype($this->Gameboard[$this->coordinates['ligne'] - $j][$this->coordinates['colonne'] - $j]) == 'object'
                    && $this->Gameboard[$this->coordinates['ligne'] - $j][$this->coordinates['colonne'] - $j]->color == $this->color) {
                        $i=0;
                    }

                    $j++;
                }

                else{
                    $i = 0;
                }
            }

            return $legalMoves;
        }

        function downLeft(){
            $i = 1;
            $j = 1;
            $legalMoves = array();

            while ($i) {
                if ($this->coordinates['ligne'] + $j <= 7 && $this->coordinates['colonne'] - $j >= 0){
                        if ($this->Gameboard[$this->coordinates['ligne'] + $j][$this->coordinates['colonne'] - $j] === 0) {
                            $legalMoves[] = array('colonne' => $this->coordinates['colonne'] - $j, 'ligne' => $this->coordinates['ligne'] + $j );
                        }
                        elseif (gettype($this->Gameboard[$this->coordinates['ligne'] + $j][$this->coordinates['colonne'] - $j]) == 'object'
                        && $this->Gameboard[$this->coordinates['ligne'] + $j][$this->coordinates['colonne'] - $j]->color != $this->color) {
                            $legalMoves[] = array('colonne' => $this->coordinates['colonne'] - $j, 'ligne' => $this->coordinates['ligne'] + $j);
                            $i=0;
                        }
                        elseif (gettype($this->Gameboard[$this->coordinates['ligne'] + $j][$this->coordinates['colonne'] - $j]) == 'object'
                        && $this->Gameboard[$this->coordinates['ligne'] + $j][$this->coordinates['colonne'] - $j]->color == $this->color) {
                            $i=0;
                        }

                    $j++;
                }
                else{
                    $i = 0;
                }
            }

            return $legalMoves;
        }

        function downRight(){
            $i = 1;
            $j = 1;
            $legalMoves = array();
            while ($i) {
                if ($this->coordinates['ligne'] + $j <= 7 && $this->coordinates['colonne'] + $j <= 7){
                    if (!$this->Gameboard[$this->coordinates['ligne'] + $j][$this->coordinates['colonne'] + $j]) {
                        $legalMoves[] = array('colonne' => $this->coordinates['colonne'] + $j, 'ligne' => $this->coordinates['ligne'] + $j );
                    }
                    elseif (gettype($this->Gameboard[$this->coordinates['ligne'] + $j][$this->coordinates['colonne'] + $j]) == 'object'
                    && $this->Gameboard[$this->coordinates['ligne'] + $j][$this->coordinates['colonne'] + $j]->color != $this->color) {
                        $legalMoves[] = array('colonne' => $this->coordinates['colonne'] + $j, 'ligne' => $this->coordinates['ligne'] + $j);
                        $i=0;
                    }
                    elseif (gettype($this->Gameboard[$this->coordinates['ligne'] + $j][$this->coordinates['colonne'] + $j]) == 'object'
                    && $this->Gameboard[$this->coordinates['ligne'] + $j][$this->coordinates['colonne'] + $j]->color == $this->color) {
                        $i=0;
                    }

                    $j++;
                }
                else{
                    $i = 0;
                }
            }

            return $legalMoves;
        }

        function move($destination)
        {

            global $db;
            $moved = 0;
            $db->beginTransaction();
            $startColumn = $this->coordinates['colonne'];
            $startRow = $this->coordinates['ligne'];
            $moveBuffer = $this->legalMoves();
            if (empty($moveBuffer)) {
                echo 'No legal move available!';
            }
            else {
                foreach ($moveBuffer as $key => $value) {
                    if ($moveBuffer[$key] == $destination) {
                        $target = $this->Gameboard[$destination['ligne']][$destination['colonne']];
                        if ($target !== 0)
                        {
                            echo $target->id;
                            $ded = "UPDATE piece 
                                    SET alive = 0
                                     WHERE id = $target->id;";
                            $db->exec($ded);

                        }
                        $this->Gameboard[$this->coordinates['ligne']][$this->coordinates['colonne']] = 0;
                        $this->coordinates = $destination;
                        $this->Gameboard[$destination['ligne']][$destination['colonne']] = $this;
                        $moved = 1;
                    }
                }
            }

            $ligne = $this->coordinates['ligne'];
            $colonne = $this->coordinates['colonne'];
            $query = "UPDATE piece
                    SET ligne = $ligne, colonne = $colonne
                    WHERE id = $this->id ;";
            $db->exec($query);

            if($moved){
                $query2 = "INSERT INTO moves (piece_id, start_row, start_column, target_row, target_column)
                           VALUES ('$this->id', '$startRow', '$startColumn', '$colonne', '$ligne')";
                $db->exec($query2);
            }
            $db->commit();
        }
    }


?>
