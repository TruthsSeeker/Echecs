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

        public function __construct($GameBoard, $color, $coordinates, $id = NULL)
        {
            global $db;
            $this->coordinates = $coordinates;
            $this->color = $color;
            $this->Gameboard = &$GameBoard;
            $this->Gameboard[$coordinates['row']][$coordinates['column']] = $this;
            //var_dump($GameBoard);
            if ($id == NULL) {
                $x = $this->coordinates['column'];
                $y = $this->coordinates['row'];
                $insert=   "INSERT INTO piece (alive, color, x, y, type)
                            VALUES ('$this->alive', '$this->color', '$x', '$y', '$this->type' )";
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
                if (!$this->Gameboard[$this->coordinates['row']][$this->coordinates['column'] + $j]) {
                    $legalMoves[] = array('column' => $this->coordinates['column'] + $j , 'row' => $this->coordinates['row'] );
                }
                elseif (gettype($this->Gameboard[$this->coordinates['row']][$this->coordinates['column'] + $j]) == 'object'
                && $this->Gameboard[$this->coordinates['row']][$this->coordinates['column'] + $j]->color != $this->color) {
                    $legalMoves[] = array('column' => $this->coordinates['column'] + $j , 'row' => $this->coordinates['row'] );
                    $i = 0;
                }
                elseif (gettype($this->Gameboard[$this->coordinates['row']][$this->coordinates['column'] + $j]) == 'object'
                && $this->Gameboard[$this->coordinates['row']][$this->coordinates['column'] + $j]->color == $this->color) {
                    $i = 0;
                }
                if ($this->coordinates['column'] + $j <7){
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
                if (!$this->Gameboard[$this->coordinates['row']][$this->coordinates['column'] - $j]) {
                    $legalMoves[] = array('column' => $this->coordinates['column'] - $j , 'row' => $this->coordinates['row'] );
                }
                elseif (gettype($this->Gameboard[$this->coordinates['row']][$this->coordinates['column'] - $j]) == 'object'
                && $this->Gameboard[$this->coordinates['row']][$this->coordinates['column'] - $j]->color != $this->color) {
                    $legalMoves[] = array('column' => $this->coordinates['column'] - $j , 'row' => $this->coordinates['row'] );
                    $i=0;
                }
                elseif (gettype($this->Gameboard[$this->coordinates['row']][$this->coordinates['column'] - $j]) == 'object'
                && $this->Gameboard[$this->coordinates['row']][$this->coordinates['column'] - $j]->color == $this->color) {
                    $i=0;
                }
                if ($this->coordinates['column'] - $j > 0 ){
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
                if (!$this->Gameboard[$this->coordinates['row'] - $j][$this->coordinates['column']]) {
                    $legalMoves[] = array('column' => $this->coordinates['column'], 'row' => $this->coordinates['row'] - $j );
                }
                elseif (gettype($this->Gameboard[$this->coordinates['row'] - $j][$this->coordinates['column']]) == 'object'
                && $this->Gameboard[$this->coordinates['row'] - $j][$this->coordinates['column']]->color != $this->color) {
                    $legalMoves[] = array('column' => $this->coordinates['column'], 'row' => $this->coordinates['row'] - $j);
                    $i=0;
                }
                elseif (gettype($this->Gameboard[$this->coordinates['row'] - $j][$this->coordinates['column']]) == 'object'
                && $this->Gameboard[$this->coordinates['row'] - $j][$this->coordinates['column']]->color == $this->color) {
                    $i=0;
                }

                if ($this->coordinates['row'] - $j > 0){
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
                if (!$this->Gameboard[$this->coordinates['row'] + $j][$this->coordinates['column']]) {
                    $legalMoves[] = array('column' => $this->coordinates['column'], 'row' => $this->coordinates['row'] - $j );
                }
                elseif (gettype($this->Gameboard[$this->coordinates['row'] + $j][$this->coordinates['column']]) == 'object'
                && $this->Gameboard[$this->coordinates['row'] - $j][$this->coordinates['column']]->color != $this->color) {
                    $legalMoves[] = array('column' => $this->coordinates['column'], 'row' => $this->coordinates['row'] - $j);
                    $i=0;
                }
                elseif (gettype($this->Gameboard[$this->coordinates['row'] + $j][$this->coordinates['column']]) == 'object'
                && $this->Gameboard[$this->coordinates['row'] - $j][$this->coordinates['column']]->color == $this->color) {
                    $i=0;
                }

                if( $this->coordinates['row'] + $j < 7){
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
            //var_dump($this->Gameboard);
            while ($i) {
                if (!$this->Gameboard[$this->coordinates['row'] - $j][$this->coordinates['column'] + $j]) {
                    $legalMoves[] = array('column' => $this->coordinates['column'] + $j, 'row' => $this->coordinates['row'] - $j );
                }
                elseif (gettype($this->Gameboard[$this->coordinates['row'] - $j][$this->coordinates['column'] + $j]) == 'object'
                && $this->Gameboard[$this->coordinates['row'] - $j][$this->coordinates['column'] + $j]->color != $this->color) {
                    $legalMoves[] = array('column' => $this->coordinates['column'] + $j, 'row' => $this->coordinates['row'] - $j);
                    $i=0;
                }
                elseif (gettype($this->Gameboard[$this->coordinates['row'] - $j][$this->coordinates['column'] + $j]) == 'object'
                && $this->Gameboard[$this->coordinates['row'] - $j][$this->coordinates['column'] + $j]->color == $this->color) {
                    $i=0;
                }
                if($this->coordinates['row'] - $j > 0 && $this->coordinates['column'] - $j > 0){
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
                //echo $this->coordinates['column'] - $j;
                //echo gettype($this->coordinates['column'] - $j);
                //$this->Gameboard[(int)$this->coordinates['row'] - $j];
                //var_dump($this->Gameboard);
                //$this->Gameboard[5];
                //die;
                $row = (int)$this->coordinates['row'] - $j;
                if ($this->Gameboard[$this->coordinates['row'] - $j][$this->coordinates['column'] - $j] === 0) {
                    $legalMoves[] = array('column' => $this->coordinates['column'] - $j, 'row' => $this->coordinates['row'] - $j );
                }
                elseif (gettype($this->Gameboard[$this->coordinates['row'] - $j][$this->coordinates['column'] - $j]) == 'object'
                && $this->Gameboard[$this->coordinates['row'] - $j][$this->coordinates['column'] - $j]->color != $this->color) {
                    $legalMoves[] = array('column' => $this->coordinates['column'] - $j, 'row' => $this->coordinates['row'] - $j);
                    $i=0;
                }
                elseif (gettype($this->Gameboard[$this->coordinates['row'] - $j][$this->coordinates['column'] - $j]) == 'object'
                && $this->Gameboard[$this->coordinates['row'] - $j][$this->coordinates['column'] - $j]->color == $this->color) {
                    $i=0;
                }

                if ($this->coordinates['row'] - $j > 0 && $this->coordinates['column'] - $j > 0){
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
                if ($this->Gameboard[$this->coordinates['row'] + $j][$this->coordinates['column'] - $j] === 0) {
                    $legalMoves[] = array('column' => $this->coordinates['column'] - $j, 'row' => $this->coordinates['row'] + $j );
                }
                elseif (gettype($this->Gameboard[$this->coordinates['row'] + $j][$this->coordinates['column'] - $j]) == 'object'
                && $this->Gameboard[$this->coordinates['row'] + $j][$this->coordinates['column'] - $j]->color != $this->color) {
                    $legalMoves[] = array('column' => $this->coordinates['column'] - $j, 'row' => $this->coordinates['row'] + $j);
                    $i=0;
                }
                elseif (gettype($this->Gameboard[$this->coordinates['row'] + $j][$this->coordinates['column'] - $j]) == 'object'
                && $this->Gameboard[$this->coordinates['row'] + $j][$this->coordinates['column'] - $j]->color == $this->color) {
                    $i=0;
                }
                if ($this->coordinates['row'] + $j < 7 && $this->coordinates['column'] - $j > 0){
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
                if (!$this->Gameboard[$this->coordinates['row'] + $j][$this->coordinates['column'] + $j]) {
                    $legalMoves[] = array('column' => $this->coordinates['column'] + $j, 'row' => $this->coordinates['row'] + $j );
                }
                elseif (gettype($this->Gameboard[$this->coordinates['row'] + $j][$this->coordinates['column'] + $j]) == 'object'
                && $this->Gameboard[$this->coordinates['row'] + $j][$this->coordinates['column'] + $j]->color != $this->color) {
                    $legalMoves[] = array('column' => $this->coordinates['column'] + $j, 'row' => $this->coordinates['row'] + $j);
                    $i=0;
                }
                elseif (gettype($this->Gameboard[$this->coordinates['row'] + $j][$this->coordinates['column'] + $j]) == 'object'
                && $this->Gameboard[$this->coordinates['row'] + $j][$this->coordinates['column'] + $j]->color == $this->color) {
                    $i=0;
                }
                if ($this->coordinates['row'] + $j < 7 && $this->coordinates['column'] + $j < 7){
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
            global $bw;
            $moveBuffer = $this->legalMoves();
            $bw = !$bw;
            if (($this->color == 'W' && !$bw) or ($this->color == 'B' && $bw))
                echo(json_encode(array('error'=>'Wadya do wrong color!!')));
            elseif (empty($moveBuffer)) {
                echo 'No legal move available!';
            }
            else {
                foreach ($moveBuffer as $key => $value) {
                    if ($moveBuffer[$key] == $destination) {
                        if ($this->Gameboard[$destination['row']][$destination['column']] !== 0)
                        {
                            $this->Gameboard[$destination['row']][$destination['column']]->alive = 0;
                            $this->Gameboard[$destination['row']][$destination['column']] = 0;
                        }
                        $this->Gameboard[$this->coordinates['row']][$this->coordinates['column']] = 0;
                        $this->coordinates = $destination;
                        $this->Gameboard[$destination['row']][$destination['column']] = $this;

                    }
                }
            }
            global $db;
            $x = $this->coordinates['column'];
            $y = $this->coordinates['row'];
            $query = "UPDATE piece
                    SET x = $x, y = $y
                    WHERE id = $this->id ;";
            $db->exec($query);
        }
    }
?>
