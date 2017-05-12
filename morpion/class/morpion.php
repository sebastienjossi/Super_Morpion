<?php
require_once 'include.inc.php';
/*
vide = 0
X    = 1
O    = 2
*/
class Morpion{
    private $id; //L'identifiant du morpion'
    private $morpionArray; //Un tableau qui correspond au morpion (3 x 3)

    //Construit un morpion tel qu'enregistré dans la base de données
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
    //Vérifie si la partie a été gagnée (si 3 signes sont allignés en diagonale, ligne ou colonne)
    public function TestIfWin(){
        $currentPosVal = 0;
        //Vérifie la position du millieu de la ligne ou de la colonne, si elle est vide, pas besoin d'aller plus loin'
        if($this->morpionArray["A2"] != 0){
            $currentPosVal = $this->morpionArray["A2"];
            //Si la position du millieu n'est pas vide, vérifie les cases adjacentes'
            if(($this->morpionArray["A1"] == $currentPosVal) && ($this->morpionArray["A3"] == $currentPosVal)){
                return $currentPosVal;
            }
        }
        if($this->morpionArray["C2"] != 0){
            $currentPosVal = $this->morpionArray["C2"];
            if(($this->morpionArray["C1"] == $currentPosVal) && ($this->morpionArray["C3"] == $currentPosVal)){
                return $currentPosVal;
            }
        }
        if($this->morpionArray["B1"] != 0){
            $currentPosVal = $this->morpionArray["B1"];
            if(($this->morpionArray["A1"] == $currentPosVal) && ($this->morpionArray["C1"] == $currentPosVal)){
                return $currentPosVal;
            }
        }
        if($this->morpionArray["B3"] != 0){
            $currentPosVal = $this->morpionArray["B3"];
            if($this->morpionArray["A3"] == $currentPosVal && $this->morpionArray["C3"] == $currentPosVal){
                return $currentPosVal;
            }
        }
        //Pour la position du centre vérifie les diagonales également
        if($this->morpionArray["B2"] != 0){
            $currentPosVal = $this->morpionArray["B2"];
            if(($this->morpionArray["A2"] == $currentPosVal && $this->morpionArray["C2"] == $currentPosVal)||
               ($this->morpionArray["B1"] == $currentPosVal && $this->morpionArray["B3"] == $currentPosVal)||
               ($this->morpionArray["A1"] == $currentPosVal && $this->morpionArray["C3"] == $currentPosVal)||
               ($this->morpionArray["C1"] == $currentPosVal && $this->morpionArray["A3"] == $currentPosVal)){
                return $currentPosVal;
            }
        }
        return 0; //si personne n'a gagné, tout les tests sont parcourus sans retourner de valeur
    }

    //Crée un nouveau morpion vide
    static public function CreateNewMorpion()
    {
        SuperMorpionDao::InsertMorpion(0, 0, 0, 0, 0, 0, 0, 0, 0);
        $tmpMorpion = new Morpion(SmPdo::GetPdo()->lastInsertId());
        return $tmpMorpion;
    }
}