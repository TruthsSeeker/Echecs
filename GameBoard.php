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
    
    public $initialBoardState = [
        ['color' => 'W', 'coordinates' => ['row' => 6, 'column' => 0], 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'W', 'coordinates' => ['row' => 6, 'column' => 1], 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'W', 'coordinates' => ['row' => 6, 'column' => 2], 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'W', 'coordinates' => ['row' => 6, 'column' => 3], 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'W', 'coordinates' => ['row' => 6, 'column' => 4], 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'W', 'coordinates' => ['row' => 6, 'column' => 5], 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'W', 'coordinates' => ['row' => 6, 'column' => 6], 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'W', 'coordinates' => ['row' => 6, 'column' => 7], 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'B', 'coordinates' => ['row' => 1, 'column' => 0], 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'B', 'coordinates' => ['row' => 1, 'column' => 1], 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'B', 'coordinates' => ['row' => 1, 'column' => 2], 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'B', 'coordinates' => ['row' => 1, 'column' => 3], 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'B', 'coordinates' => ['row' => 1, 'column' => 4], 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'B', 'coordinates' => ['row' => 1, 'column' => 5], 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'B', 'coordinates' => ['row' => 1, 'column' => 6], 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'B', 'coordinates' => ['row' => 1, 'column' => 7], 'alive' => 1, 'type' => 'Pawn'],
        ['color' => 'B', 'coordinates' => ['row' => 0, 'column' => 7], 'alive' => 1, 'type' => 'Rook'],
        ['color' => 'B', 'coordinates' => ['row' => 0, 'column' => 0], 'alive' => 1, 'type' => 'Rook'],
        ['color' => 'W', 'coordinates' => ['row' => 7, 'column' => 7], 'alive' => 1, 'type' => 'Rook'],
        ['color' => 'W', 'coordinates' => ['row' => 7, 'column' => 0], 'alive' => 1, 'type' => 'Rook'],
        ['color' => 'B', 'coordinates' => ['row' => 0, 'column' => 6], 'alive' => 1, 'type' => 'Knight'],
        ['color' => 'B', 'coordinates' => ['row' => 0, 'column' => 1], 'alive' => 1, 'type' => 'Knight'],
        ['color' => 'W', 'coordinates' => ['row' => 7, 'column' => 6], 'alive' => 1, 'type' => 'Knight'],
        ['color' => 'W', 'coordinates' => ['row' => 7, 'column' => 1], 'alive' => 1, 'type' => 'Knight'],
        ['color' => 'B', 'coordinates' => ['row' => 0, 'column' => 5], 'alive' => 1, 'type' => 'Bishop'],
        ['color' => 'B', 'coordinates' => ['row' => 0, 'column' => 2], 'alive' => 1, 'type' => 'Bishop'],
        ['color' => 'W', 'coordinates' => ['row' => 7, 'column' => 5], 'alive' => 1, 'type' => 'Bishop'],
        ['color' => 'W', 'coordinates' => ['row' => 7, 'column' => 2], 'alive' => 1, 'type' => 'Bishop'],
        ['color' => 'B', 'coordinates' => ['row' => 0, 'column' => 4], 'alive' => 1, 'type' => 'King'],
        ['color' => 'B', 'coordinates' => ['row' => 0, 'column' => 3], 'alive' => 1, 'type' => 'Queen'],
        ['color' => 'W', 'coordinates' => ['row' => 7, 'column' => 4], 'alive' => 1, 'type' => 'King'],
        ['color' => 'W', 'coordinates' => ['row' => 7, 'column' => 3], 'alive' => 1, 'type' => 'Queen'],
    ];
    
    function newGame(){
        
        foreach ($this->initialBoardState as $value){
            $buf = $this->pieceCreator($value);

        }
    }
    
    function setUpFromLoad($id)
    {
        $this->load($id);
        $pieceArray = json_decode($this->pieceID);
        $pieces = [];
        foreach ($pieceArray as $value)
        {
            global $db;
            $pieceLoader = "SELECT color, type, alive, coordinates "
                    . "FROM `piece`"
                    . "WHERE id = $value";
            $pieces[] = $db->query($pieceLoader)->fetch();
        }
        
    }
    
    function pieceCreator($pieceInfo)
    {
        switch($pieceInfo['type']){
            case 'Pawn':
                return new pawn($this->Board, $pieceInfo['color'], $pieceInfo['coordinates'], $pieceInfo['alive'], (!isset($pieceInfo['id']))? NULL: $pieceInfo['id']);
                
            case 'Rook':
                return new rook($this->Board, $pieceInfo['color'], $pieceInfo['coordinates'], $pieceInfo['alive'], (!isset($pieceInfo['id']))? NULL: $pieceInfo['id']);
                
            case 'Knight':
                return new knight($this->Board, $pieceInfo['color'], $pieceInfo['coordinates'], $pieceInfo['alive'], (!isset($pieceInfo['id']))? NULL: $pieceInfo['id']);
                
            case 'Bishop':
                return new bishop($this->Board, $pieceInfo['color'], $pieceInfo['coordinates'], $pieceInfo['alive'], (!isset($pieceInfo['id']))? NULL: $pieceInfo['id']);

            case 'King':
                return new king($this->Board, $pieceInfo['color'], $pieceInfo['coordinates'], $pieceInfo['alive'], (!isset($pieceInfo['id']))? NULL: $pieceInfo['id']);
                
            case 'Queen':
                return new queen($this->Board, $pieceInfo['color'], $pieceInfo['coordinates'], $pieceInfo['alive'], (!isset($pieceInfo['id']))? NULL: $pieceInfo['id']);
        }
    }
    
    function save($db)
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
            $save = "UPDATE board"
                    . "SET piece = $data"
                    . "WHERE id = $this->boardID";
            $db->exec($save);
        }
    }
    
    function load($id)
    {
        global $db;
        $fetch = "SELECT piece "
                . "FROM board "
                . "WHERE id = $id";
        $this->pieceID = $db->query($fetch)->fetch()[0];
        $this->boardID = $id;
    }
    
    
    function __construct() {
        $this->Board = array_fill(0, 8, array_fill(0, 8, 0));
    }
}
