<?php
namespace Turnos\Controller;

class HomeController extends Controller{

    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        global $twig;
        echo $twig->render('index.html.twig', array('nombre' => 'VUlje !!'));
    }
    
    
    public function hola(){
        var_dump('HELLO WORLD');
    }

}
?>
