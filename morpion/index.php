<!doctype html>
<?php
session_start();
include_once('include.inc.php');

if (isset($_GET['action'])) {
    if($_GET['action'] == 'login'){
        if (isset($_POST['nickname']) && isset($_POST['password'])) {
            $nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_ENCODED);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_ENCODED);

            $user = SuperMorpionDao::GetUserByNickname($nickname);

            if($user == null)
                $myGet = '?error=wrongNn';
            else
                if ($user['password'] == $password) {
                    $_SESSION['id_connected'] = $user['id_user'];
                }
                else{
                    $myGet = '?error=wrongPw';
                }
        }
    } elseif ($_GET['action'] == 'signin') {
        if (isset($_POST['nickname']) && isset($_POST['password']) && isset($_POST['email'])) {
            $nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_ENCODED);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_ENCODED);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

            SuperMorpionDao::InsertUser($nickname, $password, $email);
        }
    } elseif ($_GET['action'] == 'deco') {
            $_SESSION['id_connected'] = null;
            $myGet = '';
        }
    header('Location: index.php' . $myGet);
}
?>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title>
        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
    </head>
    <body>
        <h1>SuperMorpion</h1>
        
        <?php
            if(isset($_SESSION['id_connected']) && $_SESSION['id_connected'] != null){
                echo 'Bonjour';

                echo '<br><a href="lobby.php">Lobby</a>';

                echo '<br><a href="index.php?action=deco">Deconnection</a>';
            } else {
                DisplayLogin();
                DisplaySignin();
            }
        ?>
    </body>
</html>

<?php
    function DisplayLogin(){
        $display = '<form action="index.php?action=login" method="post">
                        <fieldset>
                        <legend><h2>Connectez-vous</h2></legend>
                        Pseudo :<br>
                        <input required type="text" name="nickname" value="">';
                        
        if(isset($_GET['error']))
            if($_GET['error'] == 'wrongNn')
                $display .= 'Ce pseudo n\'existe pas';
                        
        $display .=    '<br>
                        Mot de passe:<br>
                        <input required type="password" name="password" value="">';

        if(isset($_GET['error']))
            if($_GET['error'] == 'wrongPw')
                $display .= 'Ce mot de passe n\'est pas valide';
                        
        $display .=    '<br><br>
                        <input type="submit" value="Submit">
                        </fieldset>
                    </form>';
        echo $display;
    }

    function DisplaySignin(){
        $display = '<form action="index.php?action=signin" method="post">
                        <fieldset>
                            <legend><h2>Créez vous un compte</h2></legend>
                            Pseudo* :<br>
                            <input required type="text" name="nickname" value=""><br>
                            Email* :<br>
                            <input required type="mail" name="email" value=""><br>
                            Mot de passe* :<br>
                            <input required type="password" name="password" value=""><br><br>
                            <input type="submit" value="Submit">
                        </fieldset>
                    </form>';
        echo $display;
    }
?>