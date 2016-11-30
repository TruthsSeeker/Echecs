<!-- Classe pour ranger tout ce que je fais avec GameBoard? -->
<html>


    <head>
        <link rel="stylesheet" type="text/css" href="theme.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="chess.js"></script>
    </head>

    <body>

        <?php


        function pieceDisplay($GameBoard,$y,$x) {
            switch ($GameBoard[$y][$x]) {
                case 1 :
                echo "WKing";
                break;
                case 2:
                echo "WQueen";
                break;
                case 3 :
                echo "WBishop";
                break;
                case 4 :
                echo "WKnight";
                break;
                case 5 :
                echo "WRook";
                break;
                case 6 :
                echo "WPawn";
                break;
                case 7 :
                echo "BKing";
                break;
                case 8 :
                echo "BQueen";
                break;
                case 9 :
                echo "BBishop";
                break;
                case 10 :
                echo "BKnight";
                break;
                case 11 :
                echo "BRook";
                break;
                case 12 :
                echo "BPawn";
                break;
                default:
                echo "";
            }
        }

        function initialBoardState(&$GameBoard){
            $GameBoard[0][0]=5;
            $GameBoard[0][1]=4;
            $GameBoard[0][2]=3;
            $GameBoard[0][3]=1;
            $GameBoard[0][4]=2;
            $GameBoard[0][5]=3;
            $GameBoard[0][6]=4;
            $GameBoard[0][7]=5;
            $GameBoard[1][0]=6;
            $GameBoard[1][1]=6;
            $GameBoard[1][2]=6;
            $GameBoard[1][3]=6;
            $GameBoard[1][4]=6;
            $GameBoard[1][5]=6;
            $GameBoard[1][6]=6;
            $GameBoard[1][7]=6;
            $GameBoard[7][0]=11;
            $GameBoard[7][1]=10;
            $GameBoard[7][2]=9;
            $GameBoard[7][3]=7;
            $GameBoard[7][4]=8;
            $GameBoard[7][5]=9;
            $GameBoard[7][6]=10;
            $GameBoard[7][7]=11;
            $GameBoard[6][0]=12;
            $GameBoard[6][1]=12;
            $GameBoard[6][2]=12;
            $GameBoard[6][3]=12;
            $GameBoard[6][4]=12;
            $GameBoard[6][5]=12;
            $GameBoard[6][6]=12;
            $GameBoard[6][7]=12;
        }

        function Advance(&$GameBoard, $Y, $X){
            if ($Y+1>7){
                echo "Illegal Move";
            }
            else {
                $GameBoard[$Y+1][$X]=$GameBoard[$Y][$X];
                $GameBoard[$Y][$X]=0;
            }
        }

        function Save($GameBoard){
            foreach ($GameBoard as $key => $value) {
                echo serialize($GameBoard[$key]); #Regex to unserialize?
            }
        }



        $db= new PDO('mysql:host=localhost;dbname=chess', 'root', '');
        $GameBoard= array_fill(0, 8, array_fill(0, 8, 0));

        initialBoardState($GameBoard);
        advance($GameBoard, 1,0);
        Save($GameBoard);
        ?>
        <table>
            <?php foreach ($GameBoard as $key => $row): ?>
                <tr>
                    <?php if ($key%2==0){
                        $BWcursor=0;
                    }
                    else{
                        $BWcursor=1;
                    }?>
                    <?php foreach ($row as $key2 => $column): ?>
                        <?php if($BWcursor==0): ?>
                            <td class= "blanc">
                                <?php $BWcursor=1; ?>
                                <?php if ($GameBoard[$key][$key2] != 0): ?>
                                <img src="<?php pieceDisplay($GameBoard, $key, $key2);?>.png">
                                <?php endif; ?>
                            </td>
                        <?php else: ?>
                            <td class= "noir">
                                <?php $BWcursor=0;?>
                                <?php if ($GameBoard[$key][$key2] != 0): ?>
                                <img src="<?php pieceDisplay($GameBoard, $key, $key2);?>.png">
                                <?php endif; ?>
                            </td>
                        <?php endif;?>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>
