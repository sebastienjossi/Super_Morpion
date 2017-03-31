<?php
require_once 'include.inc.php';

class Supermorpion{
    private $id;
    private $supermorpionArray;
    private $nextmorpion;

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
        if (isset($tmpSupermorpion['id_next_morpion'])) {
            $this->nextmorpion = new Morpion($tmpSupermorpion['id_next_morpion']);
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

    public function GetNextMorpion()
    {
        return $this->nextmorpion;
    }

    public function Play($positionSM, $positionM, $intXO){
        $this->supermorpionArray[$positionSM]->Play($positionM, $intXO);
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