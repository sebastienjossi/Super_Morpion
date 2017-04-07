<?php
require_once 'include.inc.php';

class Supermorpion{
    private $id;
    private $supermorpionArray;
    private $posnextmorpion;

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

    public function Play($positionSM, $positionM, $intXO){
        $this->supermorpionArray[$positionSM]->Play($positionM, $intXO);
    }

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
        return 0;
    }

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