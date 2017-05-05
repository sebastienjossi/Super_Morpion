<?php
require_once 'include.inc.php';

class User{
    private $id;
    private $nickname;
    private $email;
    private $password;

    public function GetId()
    {
        return $this->id;
    }

    public function GetNickname()
    {
        return $this->nickname;
    }

    public function GetEmail()
    {
        return $this->email;
    }

    public function GetPassword()
    {
        return $this->password;
    }

    function __construct($id) {
        $tmpUser = SuperMorpionDao::GetUserById($id);

        $this->id = $tmpUser['id_user'];
        $this->nickname = $tmpUser['nickname'];
        $this->email = $tmpUser['email'];
        $this->password = $tmpUser['password'];
    }
}