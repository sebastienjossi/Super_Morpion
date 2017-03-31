<?php
    require_once 'include.inc.php';


    $game = new Game(48);
    $sm_test = new SuperMorpion(3);

    $sm_test->Play("A1", "A2", 2);

    echo "<pre>";
    print_r($sm_test);
    echo "</pre>";









    //$p1 = new User(1);
    //$p2 = new User(2);
    //$morpion = new Morpion(1);
    //$game = new Game(48);

    //$game->GetMorpion()->Play("A2",1);

    

