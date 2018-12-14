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
    ]

]);