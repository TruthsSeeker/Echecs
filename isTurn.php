<?php
try {
    $db= new PDO('mysql:host=localhost;dbname=chess', 'root', '');
} catch (Exception $db) {
    echo "Database Connection error";
}


$turnQuery = "SELECT p.id, p.gameboard, p.color, m.id, m.piece_id
                  FROM piece AS p, moves AS m 
                  WHERE p.id = m.piece_id AND 
                  p.gameboard = ".$_POST['gameboard']."
                  ORDER BY m.id DESC;";
$lastTurn = $db->query($turnQuery)->fetch()['color'];
echo ($_POST['player'] == $lastTurn)? 0 : 1;
