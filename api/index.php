<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../protected/config/global.php';
require ROOT_PATH.'protected/core/DB.php';
require ROOT_PATH.'protected/core/ControladorFrontal.func.php';

use \Turnos\Model\UserModel;
use \Turnos\Model\EndpointModel;


Turnos\Core\ControladorFrontal::cargaGlobal();




// API REST 
$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);

$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->get('/', function (Request $req,  Response $res, $args = []) {
    $data = (new UserModel())->getUser();
    return $res->withJson($data);
});

$app->post('/pwa/endpoint/save', function (Request $request, Response $response) {
    $params = $request->getParsedBody();
    $endpoint = $params['endpoint'];
    $key = $params['key'];
    $token = $params['token'];
    $axn = $params['axn'];

    (new EndpointModel())->add($endpoint, $key, $token, $axn);

    $resp = array('success' => true);
    return $response->withJson($resp);
});


$app->run();
 