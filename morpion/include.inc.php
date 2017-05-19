<?php
include_once("config.inc.php");
include_once("class/dao.php");
include_once("class/game.php");
include_once("class/morpion.php");
include_once("class/supermorpion.php");
include_once("class/user.php");

function print_rr($item)
{
    echo '<pre>';
    print_r($item);
    echo '</pre>';
} 
?>