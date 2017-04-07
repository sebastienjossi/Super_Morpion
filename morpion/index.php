<?php
    require_once 'include.inc.php';
    $game = new Game(48);

    function SuperMorpionHtmlTable($game)
    {
        $display = '';
        $display .= '<table border=1>';
        for ($i=1; $i <= 3; $i++) { 
            $display .= '<tr>';
            for ($j=1; $j <= 3; $j++) { 
                $display .= '<td>';
                $display .= '<table>';
                for ($h=1; $h <= 3; $h++) {
                    $display .= '<tr>'; 
                    for ($k=1; $k <= 3; $k++) { 
                        $tmpPosSupermorpion = ($i == 1 ? "A" . $j : ($i == 2 ? "B" . $j : "C" . $j));
                        $tmpPosMorpion = ($h == 1 ? "A" . $k : ($h == 2 ? "B" . $k : "C" . $k));
                        $display .= '<td>' . $game->GetSupermorpion()->GetSupermorpionArray()[$tmpPosSupermorpion]->GetMorpionArray()[$tmpPosMorpion] . '</td>';
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


    SuperMorpionHtmlTable($game);
    echo "<br><br><br><br>";

    $game->PlayNoPos("B2","C3");
    SuperMorpionHtmlTable($game);
    echo "<br><br><br><br>";

    $game->Play("A1");
    SuperMorpionHtmlTable($game);
    echo "<br><br><br><br>";

    $game->Play("C2");
    SuperMorpionHtmlTable($game);
    echo "<br><br><br><br>";

    echo $game->GetSupermorpion()->TestIfWin();





    echo "<pre>";
    print_r($game);
    echo "</pre>";





    //$p1 = new User(1);
    //$p2 = new User(2);
    //$morpion = new Morpion(1);
    //$game = new Game(48);

    //$game->GetMorpion()->Play("A2",1);

    

