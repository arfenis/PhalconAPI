<?php
/**
 * Loading local .env variables
 */
$dotenv = new Dotenv\Dotenv(BASE_PATH);
$dotenv->load();

$loader = new \Phalcon\Loader();
$loader->registerNamespaces(
  [
    'App\Services'    => APP_PATH.'services/',
    'App\Controllers' => APP_PATH.'controllers/',
    'App\Models'      => APP_PATH.'models/',
  ]
);

$loader->register();

