<!doctype html>
<?php
session_start();
include_once('include.inc.php');
?>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Lobby</title>
        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
    </head>
    <body>
        <?php
        $user = new User($_SESSION['id_connected']);

        echo 'Partie en cours contre :';
        DisplayVersusScrollList($user->GetId());

        echo 'Faire un nouvelle partie contre :';
        DisplayAllScrollList($user->GetId());
        ?>
    </body>
</html>

<?php
    function DisplayVersusScrollList($userId){
        $versusUsers = SuperMorpionDao::GetUsersVersus($userId);

        $display = '<ul style="height:200px; width:18%; overflow:hidden; overflow-y:scroll;">';
        foreach($versusUsers as $user){
            $display .=    '<li><a href="game.php?idversus=' . $user['id_user'] . '">' . $user['nickname'] . '</a></li>';
        }
        $display .= '</ul>';
        echo $display;
    }

    function DisplayAllScrollList($userId){
        $allUsers = SuperMorpionDao::GetAllUsers();
        $versusUsers = SuperMorpionDao::GetUsersVersus($userId);

        $display = '<ul style="height:200px; width:18%; overflow:hidden; overflow-y:scroll;">';
        foreach($allUsers as $user){
            if(!in_array($user, $versusUsers)){
                $display .=    '<li>' . $user['nickname'] . '</li>';
            }
        }
        $display .= '</ul>';
        echo $display;
    }
?>