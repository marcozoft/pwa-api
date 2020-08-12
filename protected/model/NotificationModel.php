<?php
namespace Turnos\Model;

use \Turnos\Model\Model;

class NotificationModel extends ModelBase{
    public $id;
    public $endpoint;
    public $public_key;
    public $auth_token;
    public $axn;
    public $date;

    public function __construct(){
        parent::__construct('notifications');
    }

    public function add($endpoint, $key, $token, $aux)
    {
        return $this->db->insert($this->table, [
            "endpoint" => $endpoint,
            "public_key" => $key,
            "auth_token" => $token,
            "axn" => $aux
        ]);
    }

    public function getAll()
    {
        return $this->db->select($this->table, '*');
    }
}
?>
