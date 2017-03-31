<?php
require_once 'include.inc.php';


class Game{
    private $id;
    private $p1;
    private $p2;
    private $next_p;
    private $winner;
    private $supermorpion;

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

    function Play($position){ //sync avec la bdd
        if($this->p1 == $this->next_p){
            $this->morpion->Play($position, 1);
            $this->next_p = $this->p2;
        } else {
            $this->morpion->Play($position, 2);
            $this->next_p = $this->p1;
        }

        if($this->morpion->TestIfWin()==1){
            echo "gg, 1 <br>";
        } else if($this->morpion->TestIfWin()==2){
            echo "gg, 2 <br>";
        }
    }

    static public function CreateNewGame($player1Param, $player2Param)
    {
        $tmpMorpion = CreateNewMorpion();
        SuperMorpionDao::InsertGame($player1Param->GetId(), $player2Param->GetId(), $tmpMorpion->GetId());
        $tmpGame = new Game(SmPdo::GetPdo()->lastInsertId());
        return $tmpGame;
    }
}