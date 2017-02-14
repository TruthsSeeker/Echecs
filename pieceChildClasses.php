<?php

	include 'pieceparentclass.php';
    class knight extends piece
    {

        function legalMoves()
        {
            $legalMoves = array();
            foreach ($this->Gameboard as $Ykey => $ligne) {
                foreach ($ligne as $Xkey => $colonne) {
                    $distance = pow($Ykey-$this->coordinates['ligne'], 2) + pow($Xkey-$this->coordinates['colonne'], 2);
                    if ($distance == 5) {//add a condition that the space must not be occupied by a friendly piece

                        $legalMoves[]= array('colonne' => $Xkey , 'ligne' => $Ykey );
                    }
                }
            }

            foreach ($legalMoves as $key => $value) {
                if (gettype($this->Gameboard[$legalMoves[$key]['ligne']][$legalMoves[$key]['colonne']]) == 'object'
                && $this->Gameboard[$legalMoves[$key]['ligne']][$legalMoves[$key]['colonne']]->color == $this->color) {
                    unset($legalMoves[$key]);
                }
            }

            return $legalMoves;
        }

		function __construct(&$GameBoard, $color, $ligne, $colonne, $alive, $id = NULL)
        {
            $this->type = 'Knight';
            parent::__construct($GameBoard, $color, $ligne, $colonne, $alive, $id);
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

        function __construct(&$GameBoard, $color, $ligne, $colonne, $alive, $id = NULL)
        {
            $this->type = 'Bishop';
            parent::__construct($GameBoard, $color, $ligne, $colonne, $alive, $id);
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

		function __construct(&$GameBoard, $color, $ligne, $colonne, $alive, $id = NULL)
        {
            $this->type = 'Queen';
            parent::__construct($GameBoard, $color, $ligne, $colonne, $alive, $id);
        }


    }

    class king extends piece
    {

        function legalMoves()
        {
            $legalMoves = array();
            foreach ($this->Gameboard as $Ykey => $ligne) {
                foreach ($ligne as $Xkey => $colonne) {
                    $distance = pow($Ykey-$this->coordinates['ligne'], 2) + pow($Xkey-$this->coordinates['colonne'], 2);
                    if ($distance == 1 || $distance == 2) {//add a condition that the space must not be occupied by a friendly piece

                        $legalMoves[]= array('colonne' => $Xkey , 'ligne' => $Ykey );
                    }
                }
            }

            return $legalMoves;
        }

		function __construct(&$GameBoard, $color, $ligne, $colonne, $alive, $id = NULL)
        {
            $this->type = 'King';
            parent::__construct($GameBoard, $color, $ligne, $colonne, $alive, $id);
        }

    }

    class rook extends piece
    {
        function legalMoves()
        {
            $legalMoves = array();
            for ($i=0; $i<=3; $i++){
				foreach (call_user_func(array($this, $this->trajectory[$i])) as $legalMove){
					$legalMoves[] = $legalMove;
				}
			}
            return $legalMoves;
        }

		function __construct(&$GameBoard, $color, $ligne, $colonne, $alive, $id = NULL)
        {
            $this->type = 'Rook';
            parent::__construct($GameBoard, $color, $ligne, $colonne, $alive, $id);
        }

    }


    class pawn extends piece
    {


        function enPassant()
        {
            $legalMoves= array();
            if ($this->color == 'W')
            {
                if ($this->coordinates['ligne'] == 4
                && $this->Gameboard[$this->coordinates['ligne']][$this->coordinates['colonne'] - 1][0] == 'BPawn'
                && $this->Gameboard[$this->coordinates['ligne'] - 1][$this->coordinates['colonne'] - 1][0] === 0)
                {
                    $legalMoves[] = array('colonne' => $this->coordinates['colonne'] - 1, 'ligne' => $this->coordinates['ligne'] - 1);
                }

                if ($this->coordinates['ligne'] == 4
                && $this->Gameboard[$this->coordinates['ligne']][$this->coordinates['colonne'] + 1][0] == 'BPawn'
                && $this->Gameboard[$this->coordinates['ligne'] - 1][$this->coordinates['colonne'] + 1][0] === 0)
                {
                    $legalMoves[] = array('colonne' => $this->coordinates['colonne'] + 1, 'ligne' => $this->coordinates['ligne'] - 1);
                }
            }
            else
            {
                if ($this->coordinates['ligne'] == 3
                && $this->Gameboard[$this->coordinates['ligne']][$this->coordinates['colonne'] - 1][0] == 'WPawn'
                && $this->Gameboard[$this->coordinates['ligne'] + 1][$this->coordinates['colonne'] - 1][0] === 0)
                {
                    $legalMoves[] = array('colonne' => $this->coordinates['colonne'] - 1, 'ligne' => $this->coordinates['ligne'] + 1);
                }

                if ($this->coordinates['ligne'] == 3
                && $this->Gameboard[$this->coordinates['ligne']][$this->coordinates['colonne'] + 1][0] !== 'WPawn'
                && $this->Gameboard[$this->coordinates['ligne'] + 1][$this->coordinates['colonne'] + 1] === 0)
                {
                    $legalMoves[] = array('colonne' => $this->coordinates['colonne'] + 1, 'ligne' => $this->coordinates['ligne'] + 1);
                }
            }
            return $legalMoves;
        }

        function legalMoves()
        {
            $legalMoves = array();
            $legalMoves[] = $this->enPassant();
            if ($this->color == 'B')
            {
                if ($this->Gameboard[$this->coordinates['ligne'] + 1][$this->coordinates['colonne']] === 0)
                {
                    $legalMoves[] = array('colonne' => $this->coordinates['colonne'], 'ligne' => $this->coordinates['ligne'] + 1);
                }
                if ($this->Gameboard[$this->coordinates['ligne'] + 1][$this->coordinates['colonne']] === 0
                && $this->Gameboard[$this->coordinates['ligne'] + 2][$this->coordinates['colonne']] === 0
                && $this->coordinates['ligne'] == 2)
                {
                    $legalMoves[] = array('colonne' => $this->coordinates['colonne'], 'ligne' => $this->coordinates['ligne'] + 2);
                }

            }
            else
            {
                if ($this->Gameboard[$this->coordinates['ligne'] - 1][$this->coordinates['colonne']] === 0)
                {
                    $legalMoves[] = array('colonne' => $this->coordinates['colonne'], 'ligne' => $this->coordinates['ligne'] - 1);
                }
                if ($this->Gameboard[$this->coordinates['ligne'] - 1][$this->coordinates['colonne']] === 0
                && $this->Gameboard[$this->coordinates['ligne'] - 2][$this->coordinates['colonne']] === 0
                && $this->coordinates['ligne'] == 6)
                {
                    $legalMoves[] = array('colonne' => $this->coordinates['colonne'], 'ligne' => $this->coordinates['ligne'] - 2);
                }
            }
            return $legalMoves;
        }

		function __construct(&$GameBoard, $color, $ligne, $colonne, $alive, $id = NULL)
        {
            $this->type = 'Pawn';
            parent::__construct($GameBoard, $color, $ligne, $colonne, $alive, $id);
        }

    }

?>
