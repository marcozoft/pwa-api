<?php

header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../protected/config/global.php';
require ROOT_PATH.'protected/core/DB.php';
require ROOT_PATH.'protected/core/ControladorFrontal.func.php';

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;


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
    $key = $params['keys']['p256dh'];
    $token = $params['keys']['auth'];
    $axn = isset($params['axn']) ? $params['axn'] : '';
    
    (new EndpointModel())->add($endpoint, $key, $token, $axn);

    $auth = array(
        'VAPID' => array(
            'subject' => 'http://localhost:8088/pwa-api/',
            'publicKey' => 'BFzWsQGVxUb3GADJj2C5XNa2hoqPZWKVaz3TptLePhYcOaDqBmIDg7sKP-BV9aJiTnI9MN5y_4jatNgbxOV6jfM',
            'privateKey' => '_NfFstemBF2_2ByyIS19IKoNYCELmbF8wPz4buDtRQY', // in the real world, this would be in a secret file
        ),
    );

    $webPush = new WebPush($auth);

    //this code was modified from the tutorial to make it more dynamic.
    //hardcoding the serviceworker push notification would not be a great practice in a real-world application
    
    $notifications = [
            'subscription' => Subscription::create([
                            'endpoint' => $params['endpoint'],
                            'publicKey' => $params['keys']['p256dh'],
                            'authToken' => $params['keys']['auth']
                        ]),
             'payload' =>   '{"title":"Notificaciones activadas","msg":"Gracias por suscribirse a nuestras notificaciones","icon":"https://pwa.victorhugovallejos.com.ar/img/icons/icon-96x96.png","badge":"images/badge.png","url":"https://youtu.be/5gSm5tLDZO4?t=47"}'
    ] ;          
    
    $res = $webPush->sendNotification(
        $notifications['subscription'],
        $notifications['payload'], // optional (defaults null)
        true // optional (defaults false)
    );
    $status = '';
    foreach ($webPush->flush() as $report) {
        $endpoint = $report->getRequest()->getUri()->__toString();
    
        if ($report->isSuccess()) {
            $status = "Message sent successfully for subscription {$endpoint}.";
        } else {
            $status = "Message failed to sent for subscription {$endpoint}: {$report->getReason()}";
        }
    }    

    $resp = array('success' => true, 'status' => $status);
    return $response->withJson($resp);
});


$app->get('/pwa/endpoints', function (Request $request, Response $response) {
    $list = (new EndpointModel())->getAll();
    
    $resp = array('success' => true, 'endpoints'=> $list);
    return $response->withJson($resp);
});


$app->run();
 


/*

require __DIR__ . '/vendor/autoload.php';
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
// here I'll get the subscription endpoint in the POST parameters
// but in reality, you'll get this information in your database
// because you already stored it (cf. push_subscription.php)
$subscriber = json_decode(file_get_contents('php://input'), true);




var_dump($subscriber);

$auth = array(
    'VAPID' => array(
        'subject' => 'http://localhost/php_push_demo-master/',
        'publicKey' => 'BFzWsQGVxUb3GADJj2C5XNa2hoqPZWKVaz3TptLePhYcOaDqBmIDg7sKP-BV9aJiTnI9MN5y_4jatNgbxOV6jfM',
        'privateKey' => '_NfFstemBF2_2ByyIS19IKoNYCELmbF8wPz4buDtRQY', // in the real world, this would be in a secret file
    ),
);
//exit($subscriber['endpoint'].' : '.$subscriber['auth'].' : '.$subscriber['p256dh']);
$webPush = new WebPush($auth);

//this code was modified from the tutorial to make it more dynamic.
//hardcoding the serviceworker push notification would not be a great practice in a real-world application

$notifications = [
        'subscription' => Subscription::create([
                        'endpoint' => $subscriber['endpoint'],
                        'publicKey' => $subscriber['p256dh'],
                        'authToken' =>$subscriber['auth']
                    ]),
         'payload' =>   '{"title":"hello","msg":"yes it works","icon":"images/icon.png","badge":"images/badge.png","url":"https://youtu.be/5gSm5tLDZO4?t=47"}'
] ;          


$res = $webPush->sendNotification(
    $notifications['subscription'],
    $notifications['payload'], // optional (defaults null)
    true // optional (defaults false)
);
foreach ($webPush->flush() as $report) {
    $endpoint = $report->getRequest()->getUri()->__toString();

    if ($report->isSuccess()) {
        echo "[v] Message sent successfully for subscription {$endpoint}.";
    } else {
        echo "[x] Message failed to sent for subscription {$endpoint}: {$report->getReason()}";
    }
}
// handle eventual errors here, and remove the subscription from your server if it is expired


*/