<?php

return new \Phalcon\Config([
    'database' => [
        'adapter'     => 'Mysql',
        'host'        => $_ENV['DATA_DB_HOST'],
        'username'    => $_ENV['DATA_DB_USER'],
        'password'    => $_ENV['DATA_DB_PASS'],
        'dbname'      => 'gonano',
        'charset'     => 'utf8',
    ],
    'application' => [
        'controllersDir' => "app/controllers/",
        'modelsDir' => "app/models/",
        'baseUri' => "/",
    ],
]);