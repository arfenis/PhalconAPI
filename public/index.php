<?php


define('BASE_PATH','/app/');
define('APP_PATH',BASE_PATH.'api/');

try {
  // Loading Configs
  $config = require(APP_PATH . 'config/config.php');

  // Autoloading classes
  require APP_PATH . 'config/loader.php';

  // Initializing DI container
  /** @var \Phalcon\DI\FactoryDefault $di */
  $di = require APP_PATH . 'config/di.php';

  // Initializing application
  $app = new \Phalcon\Mvc\Micro();

  // Setting DI container
  $app->setDI($di);

  // Setting up routing
  require APP_PATH . 'config/routes.php';

  // Making the correct answer after executing
  $app->after(
    function () use ($app) {
      // Returning a successful response
    }
  );

  // Processing request
  $app->handle();
} catch (\Exception $e) {
  // Returning an error response
}