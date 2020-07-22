<?php
namespace Turnos\Core;

use Medoo\Medoo;
 
class DB {

    public static function create() {
        if($_SERVER['HTTP_HOST'] == "localhost:8088")
        {
            return new Medoo([
                'database_type' => "mysql",
                'database_name' => "pwa",
                'server' => "studio_db",
                'username' => "root",
                'password' => "root",
            ]);            
        }
        else
        {
            return new Medoo([
                'database_type' => "mysql",
                'database_name' => "u498783324_pwa_api",
                'server' => "localhost",
                'username' => "u498783324_user_pwa_api",
                'password' => "!2mXuNvv|Qe",
            ]);                        
        }    
    }
    
}
?>