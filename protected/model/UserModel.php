<?php
namespace Turnos\Model;

use \Turnos\Model\Model;

class UserModel extends ModelBase{
    public $id;
    public $email;
    public $password;

    public function __construct(){
        parent::__construct('users');
    }

    public function getUser()
    {
        return $this->db->select($this->table, "*", [
            "id" => 7
        ]);
    }

}
?>
