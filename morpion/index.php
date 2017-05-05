<!doctype html>
<?php
include_once('include.inc.php');

if (isset($_GET['action'])) {
    if($_GET['action'] == 'login'){
        if (isset($_POST['nickname']) && isset($_POST['password'])) {
            $nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_ENCODED);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_ENCODED);
        }
    } elseif ($_GET['action'] == 'signin') {
        if (isset($_POST['nickname']) && isset($_POST['password']) && isset($_POST['email'])) {
            $nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_ENCODED);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_ENCODED);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        }
    }
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
        
        <form action="index.php?action=login">
            <fieldset>
                <legend><h2>Connectez-vous</h2></legend>
                Pseudo :<br>
                <input required type="text" name="nickname" value=""><br>
                Mot de passe:<br>
                <input required type="password" name="password" value=""><br><br>
                <input type="submit" value="Submit">
            </fieldset>
        </form>

        <form action="index.php?action=signin">
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
        </form>
    </body>
</html>