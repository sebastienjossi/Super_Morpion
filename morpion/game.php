<?php
require_once 'include.inc.php';


class Game{
    private $id; //identifiant de la partie
    private $p1; //Player1 : un joueur
    private $p2; //Player2 : un deuxième joueur
    private $next_p; //Le prochain joueur qui doit jouer (C'est son tour)
    private $winner; //Le gagnant de la partie
    private $supermorpion; //Le supermorpion

    public function GetId()
    {
        return $this->id;
    }

    public function GetPlayer1()
    {
        return $this->p1;
    }

    public function GetPlayer2()
    {
        return $this->p2;
    }

    public function GetNextPlayer()
    {
        return $this->next_p;
    }

    public function GetWinner()
    {
        return $this->winner;
    }
    
    public function GetSupermorpion()
    {
        return $this->supermorpion;
    }

    function __construct($id) {
        $tmpGame = SuperMorpionDao::GetGameById($id);

        $this->id = $tmpGame['id_game'];
        $this->p1 = new User($tmpGame['id_player_1']);
        $this->p2 = new User($tmpGame['id_player_2']);
        $this->next_p = new User($tmpGame['id_next_turn_player']);
        $this->winner = new User($tmpGame['id_winner']);
        $this->supermorpion = new Supermorpion($tmpGame['id_supermorpion']);
    }

    //Permet de jouer à une position du morpion (met le bon signe en fonction du joueur et determine le prochain joueur)
    function Play($positionM){ //sync avec la bdd
        if($this->p1 == $this->next_p){
            $this->supermorpion->Play($this->supermorpion->GetPosNextMorpion(),$positionM, 1);
            $this->next_p = $this->p2;
        } else {
            $this->supermorpion->Play($this->supermorpion->GetPosNextMorpion(),$positionM, 2);
            $this->next_p = $this->p1;
        }
        $this->supermorpion->SetPosNextMorpion($positionM);
    }

    //Permet de joueur à une position d'un morpion du super Supermorpion
    function PlayNoPos($positionSM, $positionM){
        if($this->p1 == $this->next_p){
            $this->supermorpion->Play($positionSM, $positionM, 1);
            $this->next_p = $this->p2;
        } else {
            $this->supermorpion->Play($positionSM, $positionM, 2);
            $this->next_p = $this->p1;
        }
        $this->supermorpion->SetPosNextMorpion($positionM);
    }

    //Crée une nouvelle partie avec deux joueurs
    static public function CreateNewGame($player1Param, $player2Param)
    {
        $tmpMorpion = CreateNewMorpion();
        SuperMorpionDao::InsertGame($player1Param->GetId(), $player2Param->GetId(), $tmpMorpion->GetId());
        $tmpGame = new Game(SmPdo::GetPdo()->lastInsertId());
        return $tmpGame;
    }
}