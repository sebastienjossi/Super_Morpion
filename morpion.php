<?php
/*
vide = 0
O    = 1
X    = 2
*/
class Morpion{
    private $morpionArray;

    function __construct() {
        $this->morpionArray = array(
            "A1" => 0,
            "A2" => 0,
            "A3" => 0,
            "B1" => 0,
            "B2" => 0,
            "B3" => 0,
            "C1" => 0,
            "C2" => 0,
            "C3" => 0,
        );
    }
    public function GetMorpionArray()
    {
        return $this->morpionArray;
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
si O gagne retourne 1
si X gagne retourne 2
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
}