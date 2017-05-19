<?php
session_start();
include_once('include.inc.php');

$game = new Game(48);
$posSupermorpion = explode('-',$_GET['pos'])[0];
$posMorpion = explode('-',$_GET['pos'])[1];

if($game->GetSupermorpion()->GetPosNextMorpion() != null){
    $game->Play($posMorpion);
} else {
    $game->PlayNoPos($posSupermorpion, $posMorpion);
}

if($game->GetPlayer1()->GetId() == $_SESSION['id_connected']){
    header('location:game.php?idversus=' . $game->GetPlayer2()->GetId());
} else {
    header('location:game.php?idversus=' . $game->GetPlayer1()->GetId());
}
?>