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
    
    public function setUp(){
        $buffer = array(
        new bishop($this->Board, 'W', array('row' => 7, 'column' => 2)),
        new bishop($this->Board, 'W', array('row' => 7, 'column' => 5)),
        new bishop($this->Board, 'B', array('row' => 0, 'column' => 2)),
        new bishop($this->Board, 'B', array('row' => 0, 'column' => 5)),
        new rook($this->Board, 'W', array('row' => 7, 'column' => 0)),
        new rook($this->Board, 'W', array('row' => 7, 'column' => 7)),
        new rook($this->Board, 'B', array('row' => 0, 'column' => 0)),
        new rook($this->Board, 'B', array('row' => 0, 'column' => 7)),
        new king($this->Board, 'W', array('row' => 7, 'column' => 4)),
        new king($this->Board, 'B', array('row' => 0, 'column' => 4)),
        new queen($this->Board, 'W', array('row' => 7, 'column' => 3)),
        new queen($this->Board, 'B', array('row' => 0, 'column' => 3)),
        new knight($this->Board, 'W', array('row' => 7, 'column' => 1)),
        new knight($this->Board, 'W', array('row' => 7, 'column' => 6)),
        new knight($this->Board, 'B', array('row' => 0, 'column' => 1)),
        new knight($this->Board, 'B', array('row' => 0, 'column' => 6)),
    	new pawn($this->Board, 'W', array('row' => 6, 'column' => 0)),
        new pawn($this->Board, 'W', array('row' => 6, 'column' => 1)),
        new pawn($this->Board, 'W', array('row' => 6, 'column' => 2)),
        new pawn($this->Board, 'W', array('row' => 6, 'column' => 3)),
        new pawn($this->Board, 'W', array('row' => 6, 'column' => 4)),
        new pawn($this->Board, 'W', array('row' => 6, 'column' => 5)),
        new pawn($this->Board, 'W', array('row' => 6, 'column' => 6)),
        new pawn($this->Board, 'W', array('row' => 6, 'column' => 7)),
        new pawn($this->Board, 'B', array('row' => 1, 'column' => 0)),
        new pawn($this->Board, 'B', array('row' => 1, 'column' => 1)),
        new pawn($this->Board, 'B', array('row' => 1, 'column' => 2)),
        new pawn($this->Board, 'B', array('row' => 1, 'column' => 3)),
        new pawn($this->Board, 'B', array('row' => 1, 'column' => 4)),
        new pawn($this->Board, 'B', array('row' => 1, 'column' => 5)),
        new pawn($this->Board, 'B', array('row' => 1, 'column' => 6)),
        new pawn($this->Board, 'B', array('row' => 1, 'column' => 7))
        );
        var_dump($this->Board);
        foreach ($buffer as $value){
            $this->pieceID[] = $value->id;
        }
    }
    
    function save($db)
    {
        $data = json_encode($this->pieceID);
        $save = "INSERT INTO board (piece)
                VALUES('$data')";
        $db->exec($save);
    }
    
    
    
    public function __construct() {
        $this->Board = array_fill(0, 8, array_fill(0, 8, 0));
    }
}
