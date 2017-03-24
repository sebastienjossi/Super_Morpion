<?php

require_once 'config.inc.php';

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
    static function GetGameById($id){
        $req = "SELECT id_game, id_player_1, id_player_2, id_next_turn_player, id_winner, id_supermorpion FROM game WHERE id_game = :id";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->bindParam(':id', $id);   
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    static function InsertGame($id_p1, $id_p2, $id_morpion){
        $req = "INSERT INTO game (id_player_1, id_player_2, id_supermorpion) VALUES (:idP1, :idP2, :idMorpion)";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->bindParam(':idP1', $id_p1);   
        $sql->bindParam(':idP2', $id_p2);   
        $sql->bindParam(':idMorpion', $id_morpion);   
        $sql->execute();
    }

    static function UpdateGame($fieldName, $value){
        $req = "UPDATE game SET `:fieldname` = `:value`";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->bindParam(':fieldName', $fieldName);   
        $sql->bindParam(':value', $value);    
        $sql->execute();
    }

    static function GetUserById($id){
        $req = "SELECT id_user, nickname, email, password FROM user WHERE id_user = :id";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->bindParam(':id', $id);   
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    static function GetAllMorpions(){
        $req = "SELECT id_morpion, A1, A2, A3, B1, B2, B3, C1, C2, C3 FROM morpion";
        $sql = SmPdo::GetPdo()->prepare($req); 
        //$sql->bindParam(':id', $idUser);   
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    static function GetMorpionById($id){
        $req = "SELECT id_morpion, A1, A2, A3, B1, B2, B3, C1, C2, C3 FROM morpion WHERE id_morpion = :id";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->bindParam(':id', $id);   
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

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

    static function UpdateMorpion($nomChamp, $updatedValue, $id){
        $req = "UPDATE morpion SET :nomChamp = ':updatedValue' WHERE id_morpion = :id";
        $sql = SmPdo::GetPdo()->prepare($req); 
        $sql->bindParam(':id', $id);   
        $sql->bindParam(':nomChamp', $nomChamp);  
        $sql->bindParam(':updatedValue', $updatedValue);  
        $sql->execute();
    }
}
