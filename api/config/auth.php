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
