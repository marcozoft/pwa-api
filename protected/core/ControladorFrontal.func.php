<?php
namespace Turnos\Core;
    
//FUNCIONES PARA EL CONTROLADOR FRONTAL

class ControladorFrontal {

    public static function cargaGlobal(){
        //Incluir todos los modelos
        require_once (ROOT_PATH."protected/model/ModelBase.php");
        foreach(glob(ROOT_PATH."protected/model/*.php") as $file){
            require_once $file;
        }         

        require_once ROOT_PATH."protected/controller/Controller.php";
    }
    
    public static function cargarControlador($controller){
        $controlador=ucwords($controller).'Controller';
        $strFileController='/controller/'.$controlador.'.php';
        
        if(!is_file($strFileController)){
            $strFileController='/controller/'.ucwords(CONTROLADOR_DEFECTO).'Controller.php';   
        }

        $controladorComplete = 'Turnos\\Controller\\'. $controlador;
        $controllerObj = new $controladorComplete();
        return $controllerObj;
    }

    public static function cargarAccion($controllerObj,$action){
        $accion=$action;
        $controllerObj->$accion();
    }

    public static function lanzarAccion($controllerObj){
        if(isset($_GET["action"]) && method_exists($controllerObj, $_GET["action"])){
            ControladorFrontal::cargarAccion($controllerObj, $_GET["action"]);
        }else{
            ControladorFrontal::cargarAccion($controllerObj, ACCION_DEFECTO);
        }
    }

}
?>
