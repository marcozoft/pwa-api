<?php
    define("NOMBRE_SITIO", "pwa-api");

    define("CONTROLADOR_DEFECTO", "Home");
    define("ACCION_DEFECTO", "index");

	ini_set('memory_limit', '1024M');	

	
	if($_SERVER['HTTP_HOST'] == "localhost:8088")
	{
		$url = "http://".$_SERVER['HTTP_HOST']."/".NOMBRE_SITIO."/";
		error_reporting(E_ALL);
	
	}
	else
	{
		$url = ($_SERVER['HTTPS'] == 'on' ? 'https' : 'http') . '://';
		$url .= $_SERVER['SERVER_NAME']."/";
		error_reporting(0);
		$twig_loader = new Twig_Loader_Filesystem('../views');
		$twig = new Twig_Environment($twig_loader, array('cache' => '../cache/twig',));		
	}

	define("ROOT_PATH", ($_SERVER['DOCUMENT_ROOT'].'/'.NOMBRE_SITIO.'/'));

	define("PAGINACION_CANTIDAD", 20);


	define("RUTA_IMAGENES", "uploads/images/");
	define("RUTA_PDF", "uploads/pdf/");

	define("API_GOOGLE_MAP", "AIzaSyCbcAjjpAFor_hMhjxP4NnSgtdPIwUSFA4");
	define("API_GOOGLE_RECAPTCHA", "6LcymrEUAAAAAM9d96u1DUmlZpk8417so2180bAW");
		
	define("MAP_CENTRO_LAT", "-34.58089243325939");
	define("MAP_CENTRO_LON", "-58.40910436925128");
	define("MAP_ICON", $url . "img/site/icon-location2.png");

	
	/*   SMTP  */
	define("SMTP_HOST", "smtp.gmail.com");
	define("SMTP_USER", "consultas@inatec.com.ar");
	define("SMTP_PASSWORD", "inatec2020");
	define("SMTP_PORT", "465");
	define("SMTP_EMAIL", "consultas@inatec.com.ar");
	/*
	define("SMTP_HOST", "mail.inatec.com.ar");
	define("SMTP_USER", "info@inatec.com.ar");
	define("SMTP_PASSWORD", "Zoltan3743");
	define("SMTP_PORT", "2525");
	define("SMTP_EMAIL", "info@inatec.com.ar");	
	*/

?>
