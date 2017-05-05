<?php
require_once 'include.inc.php';

class Supermorpion{
    private $id; //L'identifiant du super moprion
    private $supermorpionArray; //Un tableau contenant dans chaque case un morpion (3x3)
    private $posnextmorpion; //Le morpion contenu dans le supermorpion dans lequel le prochain joueur à jouer doit jouer

    //Construis le supermorpion en fonction des valeurs pour chaque morpion contenues dans la base de données
    function __construct($id) {
        $tmpSupermorpion = SuperMorpionDao::GetSupermorpionById($id);

        $this->id = $tmpSupermorpion['id_supermorpion'];
        $this->supermorpionArray = array(
            "A1" => new Morpion($tmpSupermorpion['id_A1']),
            "A2" => new Morpion($tmpSupermorpion['id_A2']),
            "A3" => new Morpion($tmpSupermorpion['id_A3']),
            "B1" => new Morpion($tmpSupermorpion['id_B1']),
            "B2" => new Morpion($tmpSupermorpion['id_B2']),
            "B3" => new Morpion($tmpSupermorpion['id_B3']),
            "C1" => new Morpion($tmpSupermorpion['id_C1']),
            "C2" => new Morpion($tmpSupermorpion['id_C2']),
            "C3" => new Morpion($tmpSupermorpion['id_C3'])
        );
        if (isset($tmpSupermorpion['pos_next_morpion'])) {
            $this->nextmorpion = $tmpSupermorpion['pos_next_morpion'];
        }
    }

    public function GetId()
    {
        return $this->id;
    }

    public function GetSupermorpionArray()
    {
        return $this->supermorpionArray;
    }

    public function SetSupermorpionArray($array)
    {
        $this->supermorpionArray = $array;
    }

    public function GetPosNextMorpion()
    {
        return $this->posnextmorpion;
    }

    public function SetPosNextMorpion($pos)
    {
        $this->posnextmorpion = $pos;
    }

    //Joue (dans un morpion) à une position du supermorpion puis (dans une case) à une position du morpion avec le signe donné (XO)
    public function Play($positionSM, $positionM, $intXO){
        $this->supermorpionArray[$positionSM]->Play($positionM, $intXO);
    }

    //Vérifie si le morpion est gagné
    public function TestIfWin(){
        $currentPosVal = 0;
        if($this->supermorpionArray["A2"]->TestIfWin() != 0){
            $currentPosVal = $this->supermorpionArray["A2"]->TestIfWin();
            if($this->supermorpionArray["A1"]->TestIfWin() == $currentPosVal && $this->supermorpionArray["A3"]->TestIfWin() == $currentPosVal){
                return $currentPosVal;
            }
        }
        if($this->supermorpionArray["C2"]->TestIfWin() != 0){
            $currentPosVal = $this->supermorpionArray["C2"]->TestIfWin();
            if($this->supermorpionArray["C1"]->TestIfWin() == $currentPosVal && $this->supermorpionArray["C3"]->TestIfWin() == $currentPosVal){
                return $currentPosVal;
            }
        }
        if($this->supermorpionArray["B1"]->TestIfWin() != 0){
            $currentPosVal = $this->supermorpionArray["B1"]->TestIfWin();
            if($this->supermorpionArray["A1"]->TestIfWin() == $currentPosVal && $this->supermorpionArray["C1"]->TestIfWin() == $currentPosVal){
                return $currentPosVal;
            }
        }
        if($this->supermorpionArray["B3"]->TestIfWin() != 0){
            $currentPosVal = $this->supermorpionArray["B3"]->TestIfWin();
            if($this->supermorpionArray["A3"]->TestIfWin() == $currentPosVal && $this->supermorpionArray["C3"]->TestIfWin() == $currentPosVal){
                return $currentPosVal;
            }
        }

        if($this->supermorpionArray["B2"]->TestIfWin() != 0){
            $currentPosVal = $this->supermorpionArray["B2"]->TestIfWin();
            if(($this->supermorpionArray["A2"]->TestIfWin() == $currentPosVal && $this->supermorpionArray["C2"]->TestIfWin() == $currentPosVal)||
               ($this->supermorpionArray["B1"]->TestIfWin() == $currentPosVal && $this->supermorpionArray["B3"]->TestIfWin() == $currentPosVal)||
               ($this->supermorpionArray["A1"]->TestIfWin() == $currentPosVal && $this->supermorpionArray["C3"]->TestIfWin() == $currentPosVal)||
               ($this->supermorpionArray["C1"]->TestIfWin() == $currentPosVal && $this->supermorpionArray["A3"]->TestIfWin() == $currentPosVal)){
                return $currentPosVal;
            }
        }
        return 0; //Si tout les tests sont parcourus, le morpion n'est pas gagné
    }

    //Crée un nouveau super morpion
    static public function CreateNewSupermorpion()
    {
        SuperMorpionDao::InsertSupermorpion(Morpion::CreateNewMorpion()->GetId(),
                                            Morpion::CreateNewMorpion()->GetId(),
                                            Morpion::CreateNewMorpion()->GetId(), 
                                            Morpion::CreateNewMorpion()->GetId(), 
                                            Morpion::CreateNewMorpion()->GetId(), 
                                            Morpion::CreateNewMorpion()->GetId(), 
                                            Morpion::CreateNewMorpion()->GetId(), 
                                            Morpion::CreateNewMorpion()->GetId(), 
                                            Morpion::CreateNewMorpion()->GetId());
        $tmpSuperMorpion = new Supermorpion(SmPdo::GetPdo()->lastInsertId());
        return $tmpSuperMorpion;
    }
}

?>