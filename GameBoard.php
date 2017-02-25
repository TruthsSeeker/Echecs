<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GameBoard
 *
 * @author heinr
 */
class GameBoard {
    public $Board = array();
    
    public $pieceID = array();
    
    public $boardID;

    public $dedW = array();

    public $dedB = array();
    
    public $initialBoardState = [
        ['color' => 'W', 'ligne' => 6, 'colonne' => 0, 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'W', 'ligne' => 6, 'colonne' => 1, 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'W', 'ligne' => 6, 'colonne' => 2, 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'W', 'ligne' => 6, 'colonne' => 3, 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'W', 'ligne' => 6, 'colonne' => 4, 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'W', 'ligne' => 6, 'colonne' => 5, 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'W', 'ligne' => 6, 'colonne' => 6, 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'W', 'ligne' => 6, 'colonne' => 7, 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'B', 'ligne' => 1, 'colonne' => 0, 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'B', 'ligne' => 1, 'colonne' => 1, 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'B', 'ligne' => 1, 'colonne' => 2, 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'B', 'ligne' => 1, 'colonne' => 3, 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'B', 'ligne' => 1, 'colonne' => 4, 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'B', 'ligne' => 1, 'colonne' => 5, 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'B', 'ligne' => 1, 'colonne' => 6, 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'B', 'ligne' => 1, 'colonne' => 7, 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'B', 'ligne' => 0, 'colonne' => 7, 'alive' => 1, 'type' => 'Rook'],
        ['color' => 'B', 'ligne' => 0, 'colonne' => 0, 'alive' => 1, 'type' => 'Rook'],
        ['color' => 'W', 'ligne' => 7, 'colonne' => 7, 'alive' => 1, 'type' => 'Rook'],
        ['color' => 'W', 'ligne' => 7, 'colonne' => 0, 'alive' => 1, 'type' => 'Rook'],
        ['color' => 'B', 'ligne' => 0, 'colonne' => 6, 'alive' => 1, 'type' => 'Knight'],
        ['color' => 'B', 'ligne' => 0, 'colonne' => 1, 'alive' => 1, 'type' => 'Knight'],
        ['color' => 'W', 'ligne' => 7, 'colonne' => 6, 'alive' => 1, 'type' => 'Knight'],
        ['color' => 'W', 'ligne' => 7, 'colonne' => 1, 'alive' => 1, 'type' => 'Knight'],
        ['color' => 'B', 'ligne' => 0, 'colonne' => 5, 'alive' => 1, 'type' => 'Bishop'],
        ['color' => 'B', 'ligne' => 0, 'colonne' => 2, 'alive' => 1, 'type' => 'Bishop'],
        ['color' => 'W', 'ligne' => 7, 'colonne' => 5, 'alive' => 1, 'type' => 'Bishop'],
        ['color' => 'W', 'ligne' => 7, 'colonne' => 2, 'alive' => 1, 'type' => 'Bishop'],
        ['color' => 'B', 'ligne' => 0, 'colonne' => 4, 'alive' => 1, 'type' => 'King'],
        ['color' => 'B', 'ligne' => 0, 'colonne' => 3, 'alive' => 1, 'type' => 'Queen'],
        ['color' => 'W', 'ligne' => 7, 'colonne' => 4, 'alive' => 1, 'type' => 'King'],
        ['color' => 'W', 'ligne' => 7, 'colonne' => 3, 'alive' => 1, 'type' => 'Queen'],
    ];

    function newGame(){
        
        foreach ($this->initialBoardState as $value){
            $this->pieceCreator($value);
        }
    }

    /**
     * @param null $id
     */
    function setUpFromLoad($id = NULL)
    {
        if ($id == NULL)
        {
             $this->newGame();
             return;
        }


        $query = "SELECT * FROM piece
                  WHERE gameboard = '$id'";
        global $db;
        $pieces = $db->query($query)->fetchAll();

        foreach ($pieces as $piece) {
            $this->pieceCreator($piece);
        }
    }
    
    function pieceCreator($pieceInfo)// Soit c'est la ternaire ici qui marche pas soit c'est dans pieceParentClass.php __construct()
    {
        $pieceID = isset($pieceInfo['id']) ? $pieceInfo['id'] : NULL;

        if ($pieceInfo['alive'] == 1) {
            switch ($pieceInfo['type']) {
                case 'Pawn':
                    return new pawn($this, $pieceInfo['color'], $pieceInfo['ligne'], $pieceInfo['colonne'], $pieceInfo['alive'],
                        $pieceID);

                case 'Rook':
                    return new rook($this, $pieceInfo['color'], $pieceInfo['ligne'], $pieceInfo['colonne'], $pieceInfo['alive'],
                        $pieceID);

                case 'Knight':
                    return new knight($this, $pieceInfo['color'], $pieceInfo['ligne'], $pieceInfo['colonne'], $pieceInfo['alive'],
                        $pieceID);

                case 'Bishop':
                    return new bishop($this, $pieceInfo['color'], $pieceInfo['ligne'], $pieceInfo['colonne'], $pieceInfo['alive'],
                        $pieceID);

                case 'King':
                    return new king($this, $pieceInfo['color'], $pieceInfo['ligne'], $pieceInfo['colonne'], $pieceInfo['alive'],
                        $pieceID);

                case 'Queen':
                    return new queen($this, $pieceInfo['color'], $pieceInfo['ligne'], $pieceInfo['colonne'], $pieceInfo['alive'],
                        $pieceID);
            }
        }

        else{
            if ($pieceInfo['color'] == 'B')
                $this->dedB[] = $pieceInfo['color'].$pieceInfo['type'];
            else
                $this->dedW[] = $pieceInfo['color'].$pieceInfo['type'];
        }
    }
    
    /*function save($db)
    {
        $data = json_encode($this->pieceID);
        if ($this->boardID === NULL)
        {
            $save = "INSERT INTO board (piece)
                    VALUES('$data')";
            $db->exec($save);
            $getID = "SELECT LAST_INSERT_ID()";
            $this->boardID = (int) $db->query($getID)->fetch()[0];
        }
        else
        {
            $save = "UPDATE board
                    SET piece = $data
                    WHERE id = $this->boardID";
            $db->exec($save);
        }
    }*/
    
    function __construct($id = NULL) {
        $this->Board = array_fill(0, 8, array_fill(0, 8, 0));
        global $db;

        if ( $id == NULL)
        {
            $query = "SELECT gameboard from piece
                       ORDER BY gameboard desc limit 1";
            $lastId = (int) $db->query($query)->fetch()[0];
            //var_dump($lastId);
            $this->boardID = ++$lastId;

        }

        else
        {
            $this->boardID = $id;
        }
    }
}
