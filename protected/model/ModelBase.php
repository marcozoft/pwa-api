<?php
namespace Turnos\Model;

use \Turnos\Core\DB;

class ModelBase {
    protected $table = null;
    protected $db = null;


    public function __construct($table)
    {
        $this->db = DB::create();
        $this->table = $table;

    }

}
?>
