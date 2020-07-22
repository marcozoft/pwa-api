<?php

require 'vendor/autoload.php';
require 'protected/config/global.php';
require 'protected/core/DB.php';
require 'protected/core/ControladorFrontal.func.php';

use Turnos\Core\ControladorFrontal;
use Turnos\Core\DB;

ControladorFrontal::cargaGlobal();

global $db;
$db = new DB();

$twig_loader = new \Twig\Loader\FilesystemLoader('protected/views');
$twig = new \Twig\Environment($twig_loader, array('cache' => 'protected/cache/twig','debug' => true));	

//Cargamos controladores y acciones
if(isset($_GET["controller"])){
    $controllerObj=ControladorFrontal::cargarControlador($_GET["controller"]);
    ControladorFrontal::lanzarAccion($controllerObj);
}else{
    $controllerObj=ControladorFrontal::cargarControlador(CONTROLADOR_DEFECTO);
    ControladorFrontal::lanzarAccion($controllerObj);
}
?>
