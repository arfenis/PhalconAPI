<?php

require __DIR__ . '/../vendor/autoload.php';

use Phalcon\Mvc\Micro;
use Phalcon\Config\Adapter\Ini as ConfigIni;

define('BASE_PATH','/app/');
define('APP_PATH',BASE_PATH.'api/');

/**
 * Environment variables
 */
try {
    // Autoloading classes
  require APP_PATH.'config/loader.php';

  // Loading Configs
  $config = require(APP_PATH.'config/config.php');

  // Initializing DI container
  $di = require APP_PATH.'config/di.php';

  // Initializing application
  $app = new Micro();

  // Setting DI container
  $app->setDI($di);

  // Setting up routing
  require APP_PATH.'config/routes.php';

  // Making the correct answer after executing
  $app->after(

    function () use ($app) 
    {
          // Getting the return value of method
          $return = $app->getReturnedValue();
      
          if (is_array($return)) {
            // Transforming arrays to JSON
            $app->response->setContent(json_encode($return));
          } elseif (!strlen($return)) {
            // Successful response without any content
            $app->response->setStatusCode('204', 'No Content');
          } else {
            // Unexpected response
            throw new Exception('Bad Response');
          }

          // Sending response to the client
          $app->response->send();
        }

  );

  // AUTH MICRO
  require APP_PATH.'config/auth.php';

  $app->handle();

} catch (Exception $e) {

  echo $e->getMessage();
}