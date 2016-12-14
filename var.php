<?php
	abstract class piece
        {

            public $color = "";

            public $coordinates = array();

            public $type = "";
			
			public $Gameboard = array();

            abstract function legalMoves();
			
			public $trajectory = array ( 'up', 'down', 'left', 'right', 'upLeft', 'upRight', 'downLeft', 'downRight');
			
            function __construct($color, $type, $coordinates)
            {
				global $GameBoard;
				$this->coordinates = $coordinates;
                $this->type = $type;
				$this->color = $color;
				$GameBoard[$coordinates['row']][$coordinates['column']] = $this;
				$this->Gameboard = &$GameBoard;
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
                $moveBuffer = $this->legalMoves();
                foreach ($moveBuffer as $key => $value) {
                    if ($moveBuffer[$key] == $destination) {
                        if ($this->Gameboard[$destination['row']][$destination['column']] !== 0)
                        {
                            $this->Gameboard[$destination['row']][$destination['column']] = 0;
                        }
                        $this->Gameboard[$this->coordinates['row']][$this->coordinates['column']] = 0;
                        $this->coordinates = $destination;
                        $this->Gameboard[$destination['row']][$destination['column']] = $this;

                    }
                }
            }



        }

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

            function __construct($color, $type, $coordinates)
            {
                parent::__construct($color, $type, $coordinates);
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

            function __construct($color, $type, $coordinates)
            {
                parent::__construct($color, $type, $coordinates);
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

            function __construct($color, $type, $coordinates)
            {
                parent::__construct($color, $type, $coordinates);
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

            function __construct($color, $type, $coordinates)
            {
                parent::__construct($color, $type, $coordinates);
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

            function __construct($color, $type, $coordinates)
            {
                parent::__construct($color, $type, $coordinates);
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

            function __construct($color, $type, $coordinates)
            {
                parent::__construct($color, $type, $coordinates);
            }

        }

 ?>
