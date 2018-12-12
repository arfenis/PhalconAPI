<?php

$loader = new \Phalcon\Loader();
$loader->registerNamespaces(
  [
    'App\Services'    => APP_PATH.'services/',
    'App\Controllers' => APP_PATH.'controllers/',
    'App\Models'      => APP_PATH.'models/',
  ]
);

$loader->register();