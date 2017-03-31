<?php
require_once 'include.inc.php';
/*
vide = 0
X    = 1
O    = 2
*/
class Morpion{
    private $id;
    private $morpionArray;

    function __construct($id) {
        $tmpMorpion = SuperMorpionDao::GetMorpionById($id);

        $this->id = $tmpMorpion['id_morpion'];
        $this->morpionArray = array(
            "A1" => $tmpMorpion['A1'],
            "A2" => $tmpMorpion['A2'],
            "A3" => $tmpMorpion['A3'],
            "B1" => $tmpMorpion['B1'],
            "B2" => $tmpMorpion['B2'],
            "B3" => $tmpMorpion['B3'],
            "C1" => $tmpMorpion['C1'],
            "C2" => $tmpMorpion['C2'],
            "C3" => $tmpMorpion['C3']
        );
    }

    public function GetId()
    {
        return $this->id;
    }

    public function GetMorpionArray()
    {
        return $this->morpionArray;
    }

    public function SetMorpionArray($array)
    {
        $this->morpionArray = $array;
    }

    public function Play($position, $intXO){
        if($this->morpionArray[$position] == 0){
            $this->morpionArray[$position] = $intXO;
            return true;
        } else {
            return false;
        }
    }

/*
si personne ne/n'a gagne/é retourne 0
si X gagne retourne 1
si O gagne retourne 2
*/
    public function TestIfWin(){
        $currentPosVal = 0;
        if($this->morpionArray["A2"] != 0){
            $currentPosVal = $this->morpionArray["A2"];
            if($this->morpionArray["A1"] == $currentPosVal && $this->morpionArray["A3"] == $currentPosVal){
                return $currentPosVal;
            }
        }
        if($this->morpionArray["C2"] != 0){
            $currentPosVal = $this->morpionArray["C2"];
            if($this->morpionArray["C1"] == $currentPosVal && $this->morpionArray["C3"] == $currentPosVal){
                return $currentPosVal;
            }
        }
        if($this->morpionArray["B1"] != 0){
            $currentPosVal = $this->morpionArray["B1"];
            if($this->morpionArray["A1"] == $currentPosVal && $this->morpionArray["C1"] == $currentPosVal){
                return $currentPosVal;
            }
        }
        if($this->morpionArray["B3"] != 0){
            $currentPosVal = $this->morpionArray["B3"];
            if($this->morpionArray["A3"] == $currentPosVal && $this->morpionArray["C3"] == $currentPosVal){
                return $currentPosVal;
            }
        }

        if($this->morpionArray["B2"] != 0){
            $currentPosVal = $this->morpionArray["B2"];
            if(($this->morpionArray["A2"] == $currentPosVal && $this->morpionArray["C2"] == $currentPosVal)||
               ($this->morpionArray["B1"] == $currentPosVal && $this->morpionArray["B3"] == $currentPosVal)||
               ($this->morpionArray["A1"] == $currentPosVal && $this->morpionArray["C3"] == $currentPosVal)||
               ($this->morpionArray["C1"] == $currentPosVal && $this->morpionArray["A3"] == $currentPosVal)){
                return $currentPosVal;
            }
        }
        return 0;
    }

    static public function CreateNewMorpion()
    {
        SuperMorpionDao::InsertMorpion(0, 0, 0, 0, 0, 0, 0, 0, 0);
        $tmpMorpion = new Morpion(SmPdo::GetPdo()->lastInsertId());
        return $tmpMorpion;
    }
}