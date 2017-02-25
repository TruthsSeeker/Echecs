<?php
/*Changed function to return either 'W' or 'B' instead of a boolean
 * Equivalence check to be done in JS to facilitate recursion
 *
 * */
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
$currentTurn = 'e';



if($lastTurn == 'W')
{
    $currentTurn = 'B';
}
elseif ($lastTurn == 'B')
{
    $currentTurn = 'W';
}
else
{
    $currentTurn = 'error';
}

echo $currentTurn;
