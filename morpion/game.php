<!doctype html>
<?php
session_start();
include_once('include.inc.php');
?>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title>
        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
    </head>
    <body>
        <?php
        $game = Game::constructWithPlayersIds($_SESSION['id_connected'], $_GET['idversus']);

        if($game->GetNextPlayer()->GetId() == $_SESSION['id_connected']){
            echo 'A vous de jouer';
        } else {
            echo 'C\'est a votre adversaire de jouer';
        }

        SuperMorpionHtmlTable($game);

        echo '<pre>';
        print_r($game);
        echo '</pre>';
        ?>
    </body>
</html>

<?php
function SuperMorpionHtmlTable($game){
        $arrayImg = array(
            0 => 'vide.png',
            1 => 'croix.png',
            2 => 'cercle.png');
        $arrayImgJouer = array(
            0 => 'videAJouer.png',
            1 => 'croix.png',
            2 => 'cercle.png');


        $display = '';
        $display .= '<table>';
        for ($i=1; $i <= 3; $i++) { 
            $display .= '<tr>';
            for ($j=1; $j <= 3; $j++) { 
                $display .= '<td>';
                $display .= '<table border=1>';
                for ($h=1; $h <= 3; $h++) {
                    $display .= '<tr>'; 
                    for ($k=1; $k <= 3; $k++) { 
                        $tmpPosSupermorpion = ($i == 1 ? "A" . $j : ($i == 2 ? "B" . $j : "C" . $j));
                        $tmpPosMorpion = ($h == 1 ? "A" . $k : ($h == 2 ? "B" . $k : "C" . $k));
                        $tmpValuePos = $game->GetSupermorpion()->GetSupermorpionArray()[$tmpPosSupermorpion]->GetMorpionArray()[$tmpPosMorpion];

                        if($game->GetNextPlayer()->GetId() == $_SESSION['id_connected']){



                            
                            if($game->GetSupermorpion()->GetPosNextMorpion() != null){
                                if($game->GetSupermorpion()->GetPosNextMorpion() == $tmpPosSupermorpion){
                                    if ($tmpValuePos == 0) {
                                        $display .= '<td><a href="played.php?idgame=' . $game->GetId() . '&pos=' . $tmpPosSupermorpion . '-' . $tmpPosMorpion . '"><img src="img/' . $arrayImgJouer[$tmpValuePos] . '" alt="" height="30" width="30"></a></td>';
                                    } else {
                                        $display .= '<td><img src="img/' . $arrayImgJouer[$tmpValuePos] . '" alt="" height="30" width="30"></td>';
                                    }
                                } else {
                                    $display .= '<td><img src="img/' . $arrayImg[$tmpValuePos] . '" alt="" height="30" width="30"></td>';
                                }
                            } else {
                                if ($tmpValuePos == 0) {
                                    $display .= '<td><a href="played.php?idgame=' . $game->GetId() . '&pos=' . $tmpPosSupermorpion . '-' . $tmpPosMorpion . '"><img src="img/' . $arrayImgJouer[$tmpValuePos] . '" alt="" height="30" width="30"></a></td>';
                                } else {
                                    $display .= '<td><img src="img/' . $arrayImgJouer[$tmpValuePos] . '" alt="" height="30" width="30"></td>';
                                }
                            }




                        } else {
                            $display .= '<td><img src="img/' . $arrayImg[$tmpValuePos] . '" alt="" height="30" width="30"></td>';
                        }
                        
                    }
                    $display .= '</tr>';
                }
                $display .= '</table>';
                $display .= '</td>';
            }
            $display .= '</tr>';
        }
        $display .= '</table>';
        echo $display;
    }
?>