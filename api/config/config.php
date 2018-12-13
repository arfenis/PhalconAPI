<?php

return new \Phalcon\Config([
    'database' => [
        'adapter'     => 'Mysql',
        'host'        => getenv('DATA_DB_HOST'),
        'username'    => getenv('DATA_DB_USER'),
        'password'    => getenv('DATA_DB_PASS'),
        'dbname'      => 'gonano',
        'charset'     => 'utf8',
    ],
    'application' => [
        'controllersDir' => APP_PATH . 'controllers/',
        'modelsDir' => APP_PATH . 'models/',
        'baseUri' => "/",
    ],
    'jwt' => [
        'secretKey' => getenv('SECRETKEY'),
        'payload' => [
            'exp' => 1440,
            'iss' => 'phalcon-jwt-auth'
        ],
        'ignoreUri' => [
            '/',
            'regex:/application/',
            'regex:/users/:POST,PUT',
            '/auth/user:POST,PUT',
            '/auth/application'
        ]  
    ]

]);