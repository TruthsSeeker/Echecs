<?php

	include 'pieceparentclass.php';
    class knight extends piece
    {

        function legalMoves()
        {
            $legalMoves = array();
            foreach ($this->Gameboard as $Ykey => $row) {
                foreach ($row as $Xkey => $column) {
                    $distance = pow($Ykey-$this->coordinates['row'], 2) + pow($Xkey-$this->coordinates['column'], 2);
                    if ($distance == 5) {//add a condition that the space must not be occupied by a friendly piece

                        $legalMoves[]= array('column' => $Xkey , 'row' => $Ykey );
                    }
                }
            }

            foreach ($legalMoves as $key => $value) {
                if (gettype($this->Gameboard[$legalMoves[$key]['row']][$legalMoves[$key]['column']]) == 'object'
                && $this->Gameboard[$legalMoves[$key]['row']][$legalMoves[$key]['column']]->color == $this->color) {
                    unset($legalMoves[$key]);
                }
            }

            return $legalMoves;
        }

		function __construct($color, $type, $coordinates, $id = NULL)
        {
            parent::__construct($color, $type, $coordinates, $id);
        }

    }

    class bishop extends piece
    {

        function legalMoves()
        {
            $legalMoves = array();
            for ($i=4; $i<=7; $i++){

				foreach (call_user_func(array($this, $this->trajectory[$i])) as $legalMove){
					$legalMoves[] = $legalMove;
				}
			}
            return $legalMoves;
        }

        function __construct($color, $type, $coordinates, $id = NULL)
        {
            parent::__construct($color, $type, $coordinates, $id);
        }

    }

    class queen extends piece
    {

        function legalMoves()
        {
            $legalMoves = array();
            for ($i=0; $i<=7; $i++){
				foreach (call_user_func(array($this, $this->trajectory[$i])) as $legalMove){
					$legalMoves[] = $legalMove;
				}
			}
            return $legalMoves;
        }

		function __construct($color, $type, $coordinates, $id = NULL)
        {
            parent::__construct($color, $type, $coordinates, $id);
        }


    }

    class king extends piece
    {

        function legalMoves()
        {
            $legalMoves = array();
            foreach ($this->Gameboard as $Ykey => $row) {
                foreach ($row as $Xkey => $column) {
                    $distance = pow($Ykey-$this->coordinates['row'], 2) + pow($Xkey-$this->coordinates['column'], 2);
                    if ($distance == 1 || $distance == 2) {//add a condition that the space must not be occupied by a friendly piece

                        $legalMoves[]= array('column' => $Xkey , 'row' => $Ykey );
                    }
                }
            }

            return $legalMoves;
        }

		function __construct($color, $type, $coordinates, $id = NULL)
        {
            parent::__construct($color, $type, $coordinates, $id);
        }

    }

    class rook extends piece
    {
        function legalMoves()
        {
            $legalMoves = array();
            for ($i=0; $i<=4; $i++){
				foreach (call_user_func(array($this, $this->trajectory[$i])) as $legalMove){
					$legalMoves[] = $legalMove;
				}
			}
            return $legalMoves;
        }

		function __construct($color, $type, $coordinates, $id = NULL)
        {
            parent::__construct($color, $type, $coordinates, $id);
        }

    }


    class pawn extends piece
    {


        function enPassant()
        {
            $legalMoves= array();
            if ($this->color == 'W')
            {
                if ($this->coordinates['row'] == 4
                && $this->Gameboard[$this->coordinates['row']][$this->coordinates['column'] - 1][0] == 'BPawn'
                && $this->Gameboard[$this->coordinates['row'] - 1][$this->coordinates['column'] - 1][0] === 0)
                {
                    $legalMoves[] = array('column' => $this->coordinates['column'] - 1, 'row' => $this->coordinates['row'] - 1);
                }

                if ($this->coordinates['row'] == 4
                && $this->Gameboard[$this->coordinates['row']][$this->coordinates['column'] + 1][0] == 'BPawn'
                && $this->Gameboard[$this->coordinates['row'] - 1][$this->coordinates['column'] + 1][0] === 0)
                {
                    $legalMoves[] = array('column' => $this->coordinates['column'] + 1, 'row' => $this->coordinates['row'] - 1);
                }
            }
            else
            {
                if ($this->coordinates['row'] == 3
                && $this->Gameboard[$this->coordinates['row']][$this->coordinates['column'] - 1][0] == 'WPawn'
                && $this->Gameboard[$this->coordinates['row'] + 1][$this->coordinates['column'] - 1][0] === 0)
                {
                    $legalMoves[] = array('column' => $this->coordinates['column'] - 1, 'row' => $this->coordinates['row'] + 1);
                }

                if ($this->coordinates['row'] == 3
                && $this->Gameboard[$this->coordinates['row']][$this->coordinates['column'] + 1][0] !== 'WPawn'
                && $this->Gameboard[$this->coordinates['row'] + 1][$this->coordinates['column'] + 1] === 0)
                {
                    $legalMoves[] = array('column' => $this->coordinates['column'] + 1, 'row' => $this->coordinates['row'] + 1);
                }
            }
            return $legalMoves;
        }

        function legalMoves()
        {
            $legalMoves = array();
            $legalMoves[] = $this->enPassant();
            if ($this->startPosition == 'B')
            {
                if ($this->Gameboard[$this->coordinates['row'] + 1][$this->coordinates['column']] === 0)
                {
                    $legalMoves[] = array('column' => $this->coordinates['column'], 'row' => $this->coordinates['row'] + 1);
                }
                if ($this->Gameboard[$this->coordinates['row'] + 1][$this->coordinates['column']] === 0
                && $this->Gameboard[$this->coordinates['row'] + 2][$this->coordinates['column']] === 0
                && $this->coordinates['row'] == 2)
                {
                    $legalMoves[] = array('column' => $this->coordinates['column'], 'row' => $this->coordinates['row'] + 2);
                }

            }
            else
            {
                if ($this->Gameboard[$this->coordinates['row'] - 1][$this->coordinates['column']] === 0)
                {
                    $legalMoves[] = array('column' => $this->coordinates['column'], 'row' => $this->coordinates['row'] - 1);
                }
                if ($this->Gameboard[$this->coordinates['row'] - 1][$this->coordinates['column']] === 0
                && $this->Gameboard[$this->coordinates['row'] - 2][$this->coordinates['column']] === 0
                && $this->coordinates['row'] == 6)
                {
                    $legalMoves[] = array('column' => $this->coordinates['column'], 'row' => $this->coordinates['row'] - 2);
                }
            }
            return $legalMoves;
        }

		function __construct($color, $type, $coordinates, $id = NULL)
        {
            parent::__construct($color, $type, $coordinates, $id);
        }

    }

?>
