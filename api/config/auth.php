<?php

use Dmkit\Phalcon\Auth\Middleware\Micro as AuthMicro;

  //JWT
$authConfig = [
    'secretKey' => getenv('SECRETKEY'),
    'payload' => [
        'exp' => 1440,
        'iss' => 'phalcon-jwt-auth'
      ],
    'ignoreUri' => [
        '/',
        '/v1/register',
        '/v1/login'
      ]  
];

$auth = new AuthMicro($app, $authConfig);

// Stop the execution of routes and will immediately return a response of 401 Unauthorized

$auth->onUnauthorized(function($authMicro, $app) {

    $response = $app["response"];
    $response->setStatusCode(401, 'Unauthorized');
    $response->setContentType("application/json");

    // to get the error messages
    $response->setContent(json_encode([$authMicro->getMessages()[0]]));
    $response->send();

    // return false to stop the execution
    return false;
});