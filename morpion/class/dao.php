<?php
require_once 'include.inc.php';

class SmPdo{
    private static $dbPdo = NULL;

    public static function GetPdo(){
        try {
            if (!isset($dbPdo)) {
                $dbc = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME , DB_USER, DB_PWD, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_PERSISTENT => true));
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
        return $dbc;
    }
}

class SuperMorpionDao{
    //Récupère la partie via son identifiant
    static function GetGameById($id){
        $req = "SELECT id_game, id_player_1, id_player_2, id_next_turn_player, id_winner, id_supermorpion FROM game WHERE id_game = :id";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->bindParam(':id', $id);   
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    //Récupère la partie via les identifiants des 2 joueurs
    static function GetGameByPlayersIds($id_p1, $id_p2){
        $req = "SELECT id_game, id_player_1, id_player_2, id_next_turn_player, id_winner, id_supermorpion 
                FROM game 
                WHERE (id_player_1 = :id_p1 AND id_player_2 = :id_p2)
                OR (id_player_2 = :id_p1 AND id_player_1 = :id_p2)";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->bindParam(':id_p1', $id_p1);   
        $sql->bindParam(':id_p2', $id_p2);  
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    //Ajoute une partie liée à 2 joueurs et un morpion
    static function InsertGame($id_p1, $id_p2, $id_morpion){
        $req = "INSERT INTO game (id_player_1, id_player_2, id_supermorpion) VALUES (:idP1, :idP2, :idMorpion)";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->bindParam(':idP1', $id_p1);   
        $sql->bindParam(':idP2', $id_p2);   
        $sql->bindParam(':idMorpion', $id_morpion);   
        $sql->execute();
    }

    //Met à jour la partie via le nom du champ à modifier, et la nouvelle valeur
    static function UpdateGame($fieldName, $value, $id){
        $req = "UPDATE game SET `$fieldName` = '$value' WHERE id_game = :id";
        $sql = SmPdo::GetPdo()->prepare($req); 
        //$sql->bindParam(':value', $value);    
        $sql->bindParam(':id', $id);    
        $sql->execute();
    }

    //Ajoute un utilisateur
    static function InsertUser($nickname, $email, $password){
        $req = "INSERT INTO user (nickname, email, password) VALUES (:nickname, :email, :password)";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->bindParam(':nickname', $nickname);   
        $sql->bindParam(':email', $email);   
        $sql->bindParam(':password', $password);   
        $sql->execute();
    }

    //Récupère un utilisateur via son identifiant
    static function GetUserById($id){
        $req = "SELECT id_user, nickname, email, password FROM user WHERE id_user = :id";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->bindParam(':id', $id);   
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    //Récupère tous les utilisateurs
    static function GetAllUsers(){
        $req = "SELECT id_user, nickname, email, password FROM user";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    //Récupère tous les joueur contre qui on joue
    static function GetUsersVersus($id)
    {
        $req = "SELECT user2.id_user, user2.nickname, user2.email, user2.password 
                FROM user 
                JOIN game ON game.id_player_1 = user.id_user
                JOIN user AS user2 ON user2.id_user = game.id_player_2
                WHERE user.id_user = :id";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->bindParam(':id', $id);   
        $sql->execute();

        $tmp = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        $req = "SELECT user2.id_user, user2.nickname, user2.email, user2.password 
                FROM user 
                JOIN game ON game.id_player_2 = user.id_user
                JOIN user AS user2 ON user2.id_user = game.id_player_1
                WHERE user.id_user = :id";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->bindParam(':id', $id);   
        $sql->execute();

        $cpt = 0;
        $tmp_count = count($tmp);
        foreach($sql->fetchAll(PDO::FETCH_ASSOC) as $user){
            $tmp[$tmp_count + $cpt] = $user;

            $cpt++;
        }

        return $tmp;
    }

    //Récupère un utilisateur via son pseudo
    static function GetUserByNickname($nickname){
        $req = "SELECT id_user, nickname, email, password FROM user WHERE nickname = :nickname";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->bindParam(':nickname', $nickname);   
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    //Récupère tout les morpions
    static function GetAllMorpions(){
        $req = "SELECT id_morpion, A1, A2, A3, B1, B2, B3, C1, C2, C3 FROM morpion";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    //Récupère un morpion via son identifiant
    static function GetMorpionById($id){
        $req = "SELECT id_morpion, A1, A2, A3, B1, B2, B3, C1, C2, C3 FROM morpion WHERE id_morpion = :id";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->bindParam(':id', $id);   
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    //récupère un supermorpion via son identifiant
    static function GetSupermorpionById($id){
        $req = "SELECT id_supermorpion, id_A1, id_A2, id_A3, id_B1, id_B2, id_B3, id_C1, id_C2, id_C3, pos_next_morpion FROM supermorpion WHERE id_supermorpion = :id";
        $sql = SmPdo::GetPdo()->prepare($req);
        $sql->bindParam(':id', $id);
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    //Insère un morpion avec l'etat de chacune de ses cases
    static function InsertMorpion($A1, $A2, $A3, $B1, $B2, $B3, $C1, $C2, $C3){
        $req = "INSERT INTO supermorpion.morpion (id_morpion, A1, A2, A3, B1, B2, B3, C1, C2, C3) VALUES (NULL, :A1, :A2, :A3, :B1, :B2, :B3, :C1, :C2, :C3);";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->bindParam(':A1', $A1);   
        $sql->bindParam(':A2', $A2);   
        $sql->bindParam(':A3', $A3);   
        $sql->bindParam(':B1', $B1);   
        $sql->bindParam(':B2', $B2);   
        $sql->bindParam(':B3', $B3);   
        $sql->bindParam(':C1', $C1);   
        $sql->bindParam(':C2', $C2);   
        $sql->bindParam(':C3', $C3);   
        $sql->execute();
    }

    //modifie une des position dans un morpion
    static function UpdatePosMorpion($pos, $value, $id)
    {
        $req = "UPDATE morpion SET $pos=:value WHERE id_morpion=:id";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->bindParam(':value', $value);   
        $sql->bindParam(':id', $id);   
        $sql->execute();
    }

    //Insère un supermorpion avec l'etat de chaque morpion qu'il contient
    static function InsertSupermorpion($idA1, $idA2, $idA3, $idB1, $idB2, $idB3, $idC1, $idC2, $idC3){
        $req = "INSERT INTO supermorpion.supermorpion (id_supermorpion, id_A1, id_A2, id_A3, id_B1, id_B2, id_B3, id_C1, id_C2, id_C3) VALUES (NULL, :A1, :A2, :A3, :B1, :B2, :B3, :C1, :C2, :C3);";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->bindParam(':A1', $idA1);   
        $sql->bindParam(':A2', $idA2);   
        $sql->bindParam(':A3', $idA3);   
        $sql->bindParam(':B1', $idB1);   
        $sql->bindParam(':B2', $idB2);   
        $sql->bindParam(':B3', $idB3);   
        $sql->bindParam(':C1', $idC1);   
        $sql->bindParam(':C2', $idC2);   
        $sql->bindParam(':C3', $idC3);   
        $sql->execute();
    }

    static function UpdateSupermorpionPosNextMorpion($posNextMorpion, $id){
        $req = "UPDATE supermorpion SET pos_next_morpion=:posNextMorpion WHERE id_supermorpion=:id;";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->bindParam(':posNextMorpion', $posNextMorpion);   
        $sql->bindParam(':id', $id);    
        $sql->execute();
    }


    //Modifie le champ donnéeavec la valeur donnée du morpion via son identifiant
    static function UpdateMorpion($nomChamp, $updatedValue, $id){
        $req = "UPDATE morpion SET :nomChamp = ':updatedValue' WHERE id_morpion = :id";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->bindParam(':id', $id);   
        $sql->bindParam(':nomChamp', $nomChamp);  
        $sql->bindParam(':updatedValue', $updatedValue);  
        $sql->execute();
    }
}
