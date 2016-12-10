<? php
    function right(){
        $i = 1;
        $legalMoves = array();
        while ($i) {
            $j = 0;
            if (!$GameBoard[$this->coordinates['row']][$this->coordinates['column'] + $j]) {
                $legalMoves[] = array('column' => $this->coordinates['column'] + $j , 'row' => $this->coordinates['row'] );
            }
            elseif (gettype($GameBoard[$this->coordinates['row']][$this->coordinates['column'] + $j]) == 'object'
            && $GameBoard[$this->coordinates['row']][$this->coordinates['column'] + $j]->color != $this->color) {
                $legalMoves[] = array('column' => $this->coordinates['column'] + $j , 'row' => $this->coordinates['row'] );
                $i=0;
            }
            elseif (gettype($GameBoard[$this->coordinates['row']][$this->coordinates['column'] + $j]) == 'object'
            && $GameBoard[$this->coordinates['row']][$this->coordinates['column'] + $j]->color != $this->color) {
                $i=0;
            }
            $j++;
        }

        return $legalMoves;
    }

    function left(){
        $i = 1;
        $legalMoves = array();
        while ($i) {
            $j = 0;
            if (!$GameBoard[$this->coordinates['row']][$this->coordinates['column'] - $j]) {
                $legalMoves[] = array('column' => $this->coordinates['column'] - $j , 'row' => $this->coordinates['row'] );
            }
            elseif (gettype($GameBoard[$this->coordinates['row']][$this->coordinates['column'] - $j]) == 'object'
            && $GameBoard[$this->coordinates['row']][$this->coordinates['column'] - $j]->color != $this->color) {
                $legalMoves[] = array('column' => $this->coordinates['column'] - $j , 'row' => $this->coordinates['row'] );
                $i=0;
            }
            elseif (gettype($GameBoard[$this->coordinates['row']][$this->coordinates['column'] - $j]) == 'object'
            && $GameBoard[$this->coordinates['row']][$this->coordinates['column'] - $j]->color != $this->color) {
                $i=0;
            }
            $j++;
        }

        return $legalMoves;
    }

    function up(){
        $i = 1;
        $legalMoves = array();
        while ($i) {
            $j = 0;
            if (!$GameBoard[$this->coordinates['row'] - $j][$this->coordinates['column']]) {
                $legalMoves[] = array('column' => $this->coordinates['column'], 'row' => $this->coordinates['row'] - $j );
            }
            elseif (gettype($GameBoard[$this->coordinates['row'] - $j][$this->coordinates['column']]) == 'object'
            && $GameBoard[$this->coordinates['row'] - $j][$this->coordinates['column']]->color != $this->color) {
                $legalMoves[] = array('column' => $this->coordinates['column'], 'row' => $this->coordinates['row'] - $j);
                $i=0;
            }
            elseif (gettype($GameBoard[$this->coordinates['row'] - $j][$this->coordinates['column']]) == 'object'
            && $GameBoard[$this->coordinates['row'] - $j][$this->coordinates['column']]->color != $this->color) {
                $i=0;
            }
            $j++;
        }

        return $legalMoves;
    }

    function down(){
        $i = 1;
        $legalMoves = array();
        while ($i) {
            $j = 0;
            if (!$GameBoard[$this->coordinates['row'] - $j][$this->coordinates['column']]) {
                $legalMoves[] = array('column' => $this->coordinates['column'], 'row' => $this->coordinates['row'] - $j );
            }
            elseif (gettype($GameBoard[$this->coordinates['row'] - $j][$this->coordinates['column']]) == 'object'
            && $GameBoard[$this->coordinates['row'] - $j][$this->coordinates['column']]->color != $this->color) {
                $legalMoves[] = array('column' => $this->coordinates['column'], 'row' => $this->coordinates['row'] - $j);
                $i=0;
            }
            elseif (gettype($GameBoard[$this->coordinates['row'] - $j][$this->coordinates['column']]) == 'object'
            && $GameBoard[$this->coordinates['row'] - $j][$this->coordinates['column']]->color != $this->color) {
                $i=0;
            }
            $j++;
        }

        return $legalMoves;
    }

    function upRight(){
        $i = 1;
        $legalMoves = array();
        while ($i) {
            $j = 0;
            if (!$GameBoard[$this->coordinates['row'] - $j][$this->coordinates['column'] - $j]) {
                $legalMoves[] = array('column' => $this->coordinates['column'] - $j, 'row' => $this->coordinates['row'] - $j );
            }
            elseif (gettype($GameBoard[$this->coordinates['row'] - $j][$this->coordinates['column'] - $j]) == 'object'
            && $GameBoard[$this->coordinates['row'] - $j][$this->coordinates['column'] - $j]->color != $this->color) {
                $legalMoves[] = array('column' => $this->coordinates['column'] - $j, 'row' => $this->coordinates['row'] - $j);
                $i=0;
            }
            elseif (gettype($GameBoard[$this->coordinates['row'] - $j][$this->coordinates['column'] - $j]) == 'object'
            && $GameBoard[$this->coordinates['row'] - $j][$this->coordinates['column'] - $j]->color != $this->color) {
                $i=0;
            }
            $j++;
        }

        return $legalMoves;
    }

    function upLeft(){
        $i = 1;
        $legalMoves = array();
        while ($i) {
            $j = 0;
            if (!$GameBoard[$this->coordinates['row'] - $j][$this->coordinates['column'] - $j]) {
                $legalMoves[] = array('column' => $this->coordinates['column'] - $j, 'row' => $this->coordinates['row'] - $j );
            }
            elseif (gettype($GameBoard[$this->coordinates['row'] - $j][$this->coordinates['column'] - $j]) == 'object'
            && $GameBoard[$this->coordinates['row'] - $j][$this->coordinates['column'] - $j]->color != $this->color) {
                $legalMoves[] = array('column' => $this->coordinates['column'] - $j, 'row' => $this->coordinates['row'] - $j);
                $i=0;
            }
            elseif (gettype($GameBoard[$this->coordinates['row'] - $j][$this->coordinates['column'] - $j]) == 'object'
            && $GameBoard[$this->coordinates['row'] - $j][$this->coordinates['column'] - $j]->color != $this->color) {
                $i=0;
            }
            $j++;
        }

        return $legalMoves;
    }

    function downRight(){
        $i = 1;
        $legalMoves = array();
        while ($i) {
            $j = 0;
            if (!$GameBoard[$this->coordinates['row'] + $j][$this->coordinates['column'] - $j]) {
                $legalMoves[] = array('column' => $this->coordinates['column'] - $j, 'row' => $this->coordinates['row'] + $j );
            }
            elseif (gettype($GameBoard[$this->coordinates['row'] + $j][$this->coordinates['column'] - $j]) == 'object'
            && $GameBoard[$this->coordinates['row'] + $j][$this->coordinates['column'] - $j]->color != $this->color) {
                $legalMoves[] = array('column' => $this->coordinates['column'] - $j, 'row' => $this->coordinates['row'] + $j);
                $i=0;
            }
            elseif (gettype($GameBoard[$this->coordinates['row'] + $j][$this->coordinates['column'] - $j]) == 'object'
            && $GameBoard[$this->coordinates['row'] + $j][$this->coordinates['column'] - $j]->color != $this->color) {
                $i=0;
            }
            $j++;
        }

        return $legalMoves;
    }

    function downLeft(){
        $i = 1;
        $legalMoves = array();
        while ($i) {
            $j = 0;
            if (!$GameBoard[$this->coordinates['row'] + $j][$this->coordinates['column'] + $j]) {
                $legalMoves[] = array('column' => $this->coordinates['column'] + $j, 'row' => $this->coordinates['row'] + $j );
            }
            elseif (gettype($GameBoard[$this->coordinates['row'] + $j][$this->coordinates['column'] + $j]) == 'object'
            && $GameBoard[$this->coordinates['row'] + $j][$this->coordinates['column'] + $j]->color != $this->color) {
                $legalMoves[] = array('column' => $this->coordinates['column'] + $j, 'row' => $this->coordinates['row'] + $j);
                $i=0;
            }
            elseif (gettype($GameBoard[$this->coordinates['row'] + $j][$this->coordinates['column'] + $j]) == 'object'
            && $GameBoard[$this->coordinates['row'] + $j][$this->coordinates['column'] + $j]->color != $this->color) {
                $i=0;
            }
            $j++;
        }

        return $legalMoves;
    }
 ?>
